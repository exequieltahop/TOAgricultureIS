<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'bdate',
        'bplace',
        'address',
        'sex',
        'civil_status',
        'id_type',
        'id_dir',
    ];

    // cast
    protected $casts = [
        'bdate' => 'date'
    ];
}
