<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Observers\PermissionRoleObserver;
use App\Observers\UserPermissionRoleObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionRoleController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    //permission to user
    public function givePermissionTo()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $permissions = $user->givePermissionTo($this->request->permissions);

            DB::commit();

            return response()->json([
                'data' => [
                    'permissions' => $permissions
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions sync successfully'
                ]
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    public function detachPermissionTo()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user->attach(new UserPermissionRoleObserver());

            $permissions = $user->detachPermissionTo(['addUser']);

            return response()->json([
                'data' => [
                    'permissions' => $permissions
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions detach successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }


    }

    public function addPermissionTo()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $permissions = $user->addPermissionTo(['addUser']);

            return response()->json([
                'data' => [
                    'permissions' => $permissions
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions sync without detach successfully'
                ]
            ], 200);


        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }


    //role to user
    public function giveRoleToUser()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->giveRoleTo(['admin', 'teacher']);

            DB::commit();

            return response()->json([
                'data' => [
                    'roles' => $roles
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'roles sync successfully'
                ]
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    public function detachRoleToUser()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->detachRoleTo(['admin']);

            return response()->json([
                'data' => [
                    'roles' => $roles
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'roles detach successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }


    }

    public function addRoleToUser()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->addRoleTo(['teacher']);

            return response()->json([
                'data' => [
                    'roles' => $roles
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions sync without detach successfully'
                ]
            ], 200);


        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    //permission to role
    public function givePermissionToRole()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'role_id' => 'required|exists:roles,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $role = Role::find($this->request->role_id);

            $role->attach(new PermissionRoleObserver());

            $permissions = $role->givePermissionTo(['addUser']);

            DB::commit();

            return response()->json([
                'data' => [
                    'permissions' => $permissions
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions to role sync successfully'
                ]
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    public function detachPermissionToRole()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'role_id' => 'required|exists:roles,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $role = Role::find($this->request->role_id);

            $role->attach(new PermissionRoleObserver());

            $roles = $role->detachPermissionTo(['teacher']);

            return response()->json([
                'data' => [
                    'permissions' => $roles
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions to role detach successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

    public function addPermissionToRole()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'permissions' => 'required',
                'role_id' => 'required|exists:roles,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $role = Role::find($this->request->role_id);

            $role->attach(new PermissionRoleObserver());

            $roles = $role->addPermissionTo(['teacher']);

            return response()->json([
                'data' => [
                    'permissions' => $roles
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permissions to role detach successfully'
                ]
            ], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            $messages = '';
            if ($exception->getCode() == 400) $messages = unserialize($exception->getMessage());
            else $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages,
                    'status' => 400
                ]
            ], 200);
        }

    }

}
