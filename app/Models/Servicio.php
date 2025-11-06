<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $fillable = ['nombre', 'duracion_minutos'];

    // ✅ Relación muchos a muchos con los estilistas
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'servicio_user', 'servicio_id', 'user_id');
    }
}
