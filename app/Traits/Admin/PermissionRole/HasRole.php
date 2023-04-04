<?php


namespace App\Traits\Admin\PermissionRole;


use App\Models\Role;
use Illuminate\Support\Facades\Cache;

trait HasRole
{

    public function roles()
    {
        return $this->morphedByMany(Role::class, 'userable', 'user_has_accesses');
    }

    public function giveRoleTo(array $roles)
    {

        $roles = $this->getRoleCollection($roles);

        $this->roles()->sync($roles);

        $roles = $this->getAllRole();

        $this->cacheUserRole($roles);

        $this->notify();

        return $roles;

    }

    public function detachRoleTo(array $roles)
    {

        $roles = $this->getRoleCollection($roles);

        $this->roles()->detach($roles);

        return $this->getAllRole();

    }

    public function addRoleTo(array $roles)
    {

        $roles = $this->getRoleCollection($roles);

        $this->roles()->syncWithoutDetaching($roles);

        return $this->getAllRole();

    }

    public function hasRole($role)
    {

        $roles = Cache::remember('userRole-' . $this->mobile, 50, function () {
            return $this->getAllRole();
        });

        return $roles->contains('name', $role);

    }

    public function getAllRole()
    {
        return $this->roles;
    }

    private function getRoleCollection($roles)
    {
        return Role::whereIn('name', $roles)->get();
    }

    private function cacheUserRole($roles)
    {
        $result = Cache::put('userRole-' . $this->mobile, $roles, 50);
    }

}
