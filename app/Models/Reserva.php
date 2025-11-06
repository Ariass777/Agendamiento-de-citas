<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'servicio',
        'fecha',
        'hora',
        'admin_id',
        'estado',
    ];

    public function estilista()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function servicioObj()
    {
        return $this->belongsTo(Servicio::class, 'servicio', 'nombre');
    }
}
