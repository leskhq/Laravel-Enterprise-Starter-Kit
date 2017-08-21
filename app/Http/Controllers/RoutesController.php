<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RouteCreateRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Repositories\RouteRepository;
use App\Validators\RouteValidator;


class RoutesController extends Controller
{

    /**
     * @var RouteRepository
     */
    protected $route;

    /**
     * @var RouteValidator
     */
    protected $validator;

    public function __construct(RouteRepository $routeRepository, RouteValidator $validator)
    {
        $this->route = $routeRepository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->route->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $routes = $this->route->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $routes,
            ]);
        }
        $page_title = trans('admin/routes/general.page.index.title');
        $page_description = trans('admin/routes/general.page.index.description');

        return view('admin.routes.index', compact('routes', 'page_title', 'page_description'));

    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = new \App\Models\Route();

        $page_title = trans('admin/routes/general.page.create.title');
        $page_description = trans('admin/routes/general.page.create.description');

        return view('admin.routes.create', compact('route', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RouteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RouteCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $route = $this->route->create($request->all());

            $response = [
                'message' => 'Route created.',
                'data'    => $route->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/routes/general.status.created'));

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $route = $this->route->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $route,
            ]);
        }

        $page_title = trans('admin/routes/general.page.show.title');
        $page_description = trans('admin/routes/general.page.show.description', ['name' => $route->name]);

        return view('admin.routes.show', compact('route', 'page_title', 'page_description'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $route = $this->route->find($id);

        $page_title = trans('admin/routes/general.page.edit.title');
        $page_description = trans('admin/routes/general.page.edit.description', ['name' => $route->name]);

        return view('admin.routes.edit', compact('route', 'page_title', 'page_description'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RouteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RouteUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $route = $this->route->update($request->all(), $id);

            $response = [
                'message' => 'Route updated.',
                'data'    => $route->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/routes/general.status.updated'));

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->route->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Route deleted.',
                'deleted' => $deleted,
            ]);
        }

        Flash::success( trans('admin/routes/general.status.deleted') );

        return redirect()->back()->with('message', 'Route deleted.');
    }
}
