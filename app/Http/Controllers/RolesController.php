<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\Criteria\Role\RolesWhereDisplayNameOrDescriptionLike;
use App\Repositories\RoleRepository;
use App\Validators\RoleValidator;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @var RoleValidator
     */
    protected $validator;

    public function __construct(RoleRepository $roleRepository, RoleValidator $validator)
    {
        $this->role = $roleRepository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->role->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->role->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roles,
            ]);
        }

        $page_title = trans('admin/roles/general.page.index.title');
        $page_description = trans('admin/roles/general.page.index.description');

        return view('admin.roles.index', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = new \App\Models\Role();

        $page_title = trans('admin/roles/general.page.create.title');
        $page_description = trans('admin/roles/general.page.create.description');

        return view('admin.roles.create', compact('role', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $role = $this->role->create($request->all());

            $response = [
                'message' => 'Role created.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/roles/general.status.created'));

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
        $role = $this->role->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $role,
            ]);
        }

        $page_title = trans('admin/roles/general.page.show.title');
        $page_description = trans('admin/roles/general.page.show.description', ['name' => $role->name]);

        return view('admin.roles.show', compact('role', 'page_title', 'page_description'));
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

        $role = $this->role->find($id);

        $page_title = trans('admin/roles/general.page.edit.title');
        $page_description = trans('admin/roles/general.page.edit.description', ['name' => $role->name]);

        return view('admin.roles.edit', compact('role', 'page_title', 'page_description'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $role = $this->role->update($request->all(), $id);

            $response = [
                'message' => 'Role updated.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/roles/general.status.updated'));

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
        $deleted = $this->role->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Role deleted.',
                'deleted' => $deleted,
            ]);
        }

        Flash::success( trans('admin/roles/general.status.deleted') );

        return redirect()->back()->with('message', 'User deleted.');
    }

    /**
     * @param Request $request
     *
     * @return array|static[]
     */
    public function searchByName(Request $request)
    {
        $return_arr = null;

        $query = $request->input('query');

        $roles = $this->role->pushCriteria(new RolesWhereDisplayNameOrDescriptionLike($query))->all();

        foreach ($roles as $role) {
            $id = $role->id;
            $display_name = $role->display_name;
            $description = $role->description;

            $entry_arr = [ 'id' => $id, 'text' => "$display_name ($description)"];
            $return_arr[] = $entry_arr;
        }

        return $return_arr;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getInfo(Request $request)
    {
        $id = $request->input('id');
        $role = $this->role->find($id);

        return $role;
    }

}
