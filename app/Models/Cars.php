<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable=[
        'modelo',
        'marca',
        'anio',
        'color',
        'placa'
    ];
}
