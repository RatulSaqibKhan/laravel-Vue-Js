<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleRowTableModel extends Model
{
    protected $table = 'multiple_row_table';
    protected $fillable = [
        'id', 'std_name', 'std_roll',
    ];
}
