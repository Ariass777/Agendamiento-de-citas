<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

protected $fillable = [
    'cliente_id',
    'empleado_id',
    'servicio',
    'celular',
    'fecha',
    'hora_inicio',
    'duracion_minutos',
    'hora_fin',
    'estado'
];


public function cliente()
{
    return $this->belongsTo(Cliente::class, 'cliente_id');
}

public function empleado()
{
    return $this->belongsTo(User::class, 'empleado_id');
}

}
