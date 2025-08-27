<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes'; 

    protected $fillable = [
        'titulo',
        'descripcion',
    ];
}
