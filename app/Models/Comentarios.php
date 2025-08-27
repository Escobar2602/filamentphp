<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    public function publicaciones()
{
    return $this->belongsTo(Publicaciones::class);
}

}
