<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permission_category()
    {
        return $this->belongsTo(PermissionCategory::class);
    }

    public function fillPermissionCategory($categoryId)
    {
        $this->permission_category_id = $categoryId;
        $this->save();
    }


}
