<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'creator_id'
    ];

    protected $hidden=[
        'created_at','updated_at'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
