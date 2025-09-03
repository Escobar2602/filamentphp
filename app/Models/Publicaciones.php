<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    protected $fillable = [
        'descripcion',
        'media',
        'user_id',
    ];

    protected $casts = [
        'media' => 'array',
    ];
 
    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);  
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);   
    }
}
