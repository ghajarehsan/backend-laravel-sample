<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','value','creator_id'
    ];

    public function user_departments()
    {
        return $this->belongsToMany(UserDepartment::class);
    }


}
