<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'title_en', 'images', 'creator_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'creator_id');
    }

}
