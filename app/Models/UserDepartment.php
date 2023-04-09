<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','parent_id','creator_id'
    ];

    public function user_posts()
    {
        return $this->belongsToMany(UserPost::class);
    }

}
