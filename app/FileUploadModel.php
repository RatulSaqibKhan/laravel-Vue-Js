<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUploadModel extends Model
{
    protected $table = 'file_upload';
    protected $fillable = [
        'id', 'user_id', 'file_name', 'file_path',
    ];
}
