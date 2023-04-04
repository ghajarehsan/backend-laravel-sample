<?php


namespace App\Traits\Admin\PermissionRole;


use App\Models\Permission;
use Illuminate\Support\Facades\Cache;

trait HasPermissionRole
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
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
        Cache::put('permissionRole', $permissions, 50);
    }

}
