<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategoryFilterOption extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 'category_filter_id', 'creator_id'
    ];

}
