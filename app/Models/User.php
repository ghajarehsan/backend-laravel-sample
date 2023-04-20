<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\PermissionRole\HasRole;
use App\Services\PermissionRole\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use SplObserver;

class User extends Authenticatable implements \SplSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasPermission, HasRole;

    private $observers;

    public function __construct(array $attributes = [])
    {
        $this->observers = new \SplObjectStorage();
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getUserPermission()
    {
        return Cache::remember('userPermission-' . $this->mobile, 21600, function () {
            return $this->permissions()
                ->leftJoin('permission_categories', function ($join) {
                    $join->on('permissions.permission_category_id', '=', 'permission_categories.id');
                })
                ->select(
                    'permissions.id', 'permissions.name', 'permissions.persian_name',
                    'permission_categories.id as category_id', 'permission_categories.name as category_name'
                )
                ->get();
        });
    }

    public function getUserRole()
    {
        return Cache::remember('userRole-' . $this->mobile, 21600, function () {
            return $this->roles()
                ->select('roles.id', 'roles.name', 'roles.persian_name')
                ->get();
        });
    }

}
