<?php

namespace App\Http\Controllers;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laracasts\Flash\Flash;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;


class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @var PermissionRepository
     */
    protected $permission;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @var UserValidator
     */
    protected $validator;

    public function __construct(UserRepository $userRepository, UserValidator $validator, PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->user         = $userRepository;
        $this->validator    = $validator;
        $this->permission   = $permissionRepository;
        $this->role         = $roleRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->user->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }

        $page_title = trans('admin/users/general.page.index.title');
        $page_description = trans('admin/users/general.page.index.description');

        return view('admin.users.index', compact('users', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = new \App\Models\User();

        $page_title = trans('admin/users/general.page.create.title');
        $page_description = trans('admin/users/general.page.create.description');

        return view('admin.users.create', compact('user', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->user->create($request->all());

            $response = [
                'message' => 'User created.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/users/general.status.created'));

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
        $user = $this->user->with(['permissions', 'roles'])->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        $permissions = $this->permission->all();
        $roles       = $this->role->all();

        $page_title = trans('admin/users/general.page.show.title');
        $page_description = trans('admin/users/general.page.show.description', ['full_name' => $user->full_name]);

        return view('admin.users.show', compact('user', 'page_title', 'page_description', 'permissions', 'roles'));
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

        $user = $this->user->find($id);

        $page_title = trans('admin/users/general.page.edit.title');
        $page_description = trans('admin/users/general.page.edit.description', ['full_name' => $user->full_name]);

        return view('admin.users.edit', compact('user', 'page_title', 'page_description'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Flash::success(trans('admin/users/general.status.updated'));

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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        Flash::success( trans('admin/users/general.status.deleted') );

        return redirect()->back()->with('message', 'User deleted.');
    }
}
