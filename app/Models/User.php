<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\RestablecerPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

protected $fillable = [
    'name',
    'email',
    'password',
    // 'servicio', // eliminar si usas many-to-many
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RestablecerPassword($token));
    }

    /**
     * Relación con los servicios (muchos a muchos)
     */
public function servicios()
{
    return $this->belongsToMany(Servicio::class, 'servicio_user', 'user_id', 'servicio_id');
}



    public function horarios()
{
    return $this->hasMany(Horario::class, 'usuario_id');
}
public function estilistas()
{
    return $this->belongsToMany(User::class);
}


}