<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoUsuarioNotificacion extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $usuario;
    public $email;
    public $contraseña;

    public function __construct($usuario, $contraseña, $email)
    {
        $this->usuario = $usuario;
        $this->contraseña = $contraseña;
        $this->email = $email;
    }

    public function build()
    {
        return $this->view('mail.nuevousuarionotificacion');
    }
}
