<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;
use App\Validators\PermissionValidator;


class PermissionsController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @var PermissionValidator
     */
    protected $validator;

    public function __construct(PermissionRepository $repository, PermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $permissions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $permissions,
            ]);
        }

        $page_title = trans('admin/permissions/general.page.index.title');
        $page_description = trans('admin/permissions/general.page.index.description');

        return view('admin.permissions.index', compact('permissions', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permission = new \App\Models\Permission();

        $page_title = trans('admin/permissions/general.page.create.title');
        $page_description = trans('admin/permissions/general.page.create.description');

        return view('admin.permissions.create', compact('permission', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $permission = $this->repository->create($request->all());

            $response = [
                'message' => 'Permission created.',
                'data'    => $permission->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/permissions/general.status.created'));

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
        $permission = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $permission,
            ]);
        }

        $page_title = trans('admin/permissions/general.page.show.title');
        $page_description = trans('admin/permissions/general.page.show.description', ['name' => $permission->name]);

        return view('admin.permissions.show', compact('permission', 'page_title', 'page_description'));
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

        $permission = $this->repository->find($id);

        $page_title = trans('admin/permissions/general.page.edit.title');
        $page_description = trans('admin/permissions/general.page.edit.description', ['name' => $permission->name]);

        return view('admin.permissions.edit', compact('permission', 'page_title', 'page_description'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $permission = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Permission updated.',
                'data'    => $permission->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/permissions/general.status.updated'));

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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Permission deleted.',
                'deleted' => $deleted,
            ]);
        }

        Flash::success( trans('admin/permissions/general.status.deleted') );

        return redirect()->back()->with('message', 'Permission deleted.');
    }
}
