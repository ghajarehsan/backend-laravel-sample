<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id', 'upload_file_type', 'upload_file_id', 'name', 'main_path', 'path', 'size', 'is_private', 'mime', 'extension', 'status'
    ];


}
