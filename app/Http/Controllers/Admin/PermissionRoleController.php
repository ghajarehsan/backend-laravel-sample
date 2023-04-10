<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionCategory;
use App\Models\Role;
use App\Models\User;
use App\Observers\PermissionRoleObserver;
use App\Observers\UserPermissionRoleObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

            $permissions = $user->detachPermissionTo($this->request->permissions);

            DB::commit();

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

            $permissions = $user->addPermissionTo($this->request->permissions);

            DB::commit();

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
                'roles' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->giveRoleTo($this->request->roles);

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
                'roles' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->detachRoleTo($this->request->roles);

            DB::commit();

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
                'roles' => 'required',
                'user_id' => 'required|exists:users,id'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $user = User::find($this->request->user_id);

            $user->attach(new UserPermissionRoleObserver());

            $roles = $user->addRoleTo($this->request->roles);

            DB::commit();

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

            $permissions = $role->givePermissionTo($this->request->permissions);

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

            $roles = $role->detachPermissionTo($this->request->permissions);

            DB::commit();

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

            $roles = $role->addPermissionTo($this->request->permissions);

            DB::commit();

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

    //permission category

    public function newPermissionCategory()
    {

        DB::beginTransaction();

        try {

            $validation = Validator::make($this->request->all(), [
                'name' => 'required|max:100',
                'permissions' => 'string|max:500'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $permissions = Permission::whereIn('id', explode(',', $this->request->permissions))->get();

            if ($permissions->contains('permission_category_id', '!=', null)) throw new \Exception('یکی از سطح های دسترسی قبلا به یکی از دسته بندی ها آساین شده است');

            $permissionCategory = PermissionCategory::create([
                'name' => $this->request->name,
                'creator_id' => auth()->user()->id
            ]);

            foreach ($permissions as $keyPermission => $rowPermission) {
                $rowPermission->fillPermissionCategory($permissionCategory->id);
            }

            DB::commit();

            return response()->json([
                'data' => [
                    'permission_category' => $permissionCategory->permissions,
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permission category created successfully'
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

    public function getAllCategoryPermission()
    {

        try {

            $permissionCategory = Cache::remember('permissionCategory', 10, function () {
                return PermissionCategory::with(['permissions' => function ($query) {
                    $query->select('permissions.id', 'permissions.name', 'permissions.persian_name', 'permissions.permission_category_id');
                }])
                    ->select('permission_categories.id', 'permission_categories.name')
                    ->get();
            });

            return response()->json([
                'data' => [
                    'permissionCategory' => $permissionCategory
                ],
                'meta' => [
                    'status' => 200,
                ]
            ], 200);

        } catch (\Exception $exception) {
            $messages = $exception->getMessage();
            return response()->json([
                'meta' => [
                    'messages' => $messages
                ]
            ], 200);
        }

    }

    public function editPermissionCategory($permissionCategory)
    {

        try {

            $validation = Validator::make($this->request->all(), [
                'name' => 'required|max:100',
                'permissions' => 'string|max:500'
            ]);

            if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 400);

            $permissionCategory = PermissionCategory::find($permissionCategory);

            Permission::where('permission_category_id', $permissionCategory->id)->update([
                'permission_category_id' => null
            ]);

            Permission::whereIn('id', explode(',', $this->request->permissions))->update([
                'permission_category_id' => $permissionCategory->id
            ]);

            DB::commit();

            return response()->json([
                'data' => [
                    'permission_category' => $permissionCategory->permissions,
                ],
                'meta' => [
                    'status' => 200,
                    'messages' => 'permission category created successfully'
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
