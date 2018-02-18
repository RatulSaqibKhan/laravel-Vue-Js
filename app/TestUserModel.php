<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestUserModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'id', 'user_name', 'email', 'mobile',
    ];
}
