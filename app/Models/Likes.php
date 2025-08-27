<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public function publicaciones()
{
    return $this->belongsTo(Publicaciones::class);
}

}
