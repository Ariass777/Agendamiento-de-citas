<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // 🔹 Nombre de la tabla (por si no sigue la convención plural)
    protected $table = 'clientes';

    // 🔹 Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    // 🔗 Relación con las citas (un cliente puede tener varias citas)
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
