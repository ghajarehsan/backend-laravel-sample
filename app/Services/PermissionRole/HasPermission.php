<?php


namespace App\Services\PermissionRole;


use App\Models\Permission;
use Illuminate\Support\Facades\Cache;


trait HasPermission
{

    public function permissions()
    {
        return $this->morphedByMany(Permission::class, 'userable', 'user_has_accesses');
    }

    public function givePermissionTo(array $permissions)
    {

        $permissions = $this->getPermissionCollection($permissions);

        $this->permissions()->sync($permissions);

        $permissions = $this->getAllPermission();

        $this->cacheUserPermission($permissions);

        $this->notify();

        return $permissions;

    }

    public function detachPermissionTo(array $permissions)
    {

        $permissions = $this->getPermissionCollection($permissions);

        $this->permissions()->detach($permissions);

        return $this->getAllPermission();

    }

    public function addPermissionTo(array $permissions)
    {

        $permissions = $this->getPermissionCollection($permissions);

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this->getAllPermission();

    }

    public function hasPermission($permission)
    {

        $permissions = Cache::remember('userPermission-' . $this->mobile, 50, function () {
            return $this->getAllPermission();
        });

        return $permissions->contains('name', $permission) || $this->hasPermissionThroughRole($permission);

    }

    public function hasPermissionThroughRole($permission)
    {

        $roles = Cache::remember('userRole-' . $this->mobile, 50, function () {
            return $this->getAllRole();
        });

        $permissionRoles = Permission::where('name', $permission)->first()->roles;

        foreach ($permissionRoles as $keyRole => $rowRole) {
            if ($roles->contains('id', $rowRole->id)) return true;
        }

        return false;

    }

    private function getAllPermission()
    {
        return $this->permissions;
    }

    private function getPermissionCollection($permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    private function cacheUserPermission($permissions)
    {
        Cache::put('userPermission-' . $this->mobile, $permissions, 50);
    }

}
