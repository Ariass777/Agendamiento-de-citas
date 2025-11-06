<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestablecerPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecimiento de contraseña')
            ->greeting('¡Hola!')
            ->line('Has recibido este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.')
            ->action('Restablecer contraseña', url(route('password.reset', $this->token, false)))
            ->line('Este enlace de restablecimiento de contraseña expirará en 60 minutos.')
            ->line('Si no solicitaste el restablecimiento, no es necesario realizar ninguna acción.');
    }
}
