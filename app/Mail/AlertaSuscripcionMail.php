<?php

namespace App\Mail;

use App\Models\Suscripcion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaSuscripcionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $suscripcion;
    public $tipo;

    public function __construct(Suscripcion $suscripcion, string $tipo)
    {
        $this->suscripcion = $suscripcion;
        $this->tipo = $tipo;
    }

    public function build()
    {
        return $this->subject('⚠️ Alerta de Vencimiento de Suscripción')
            ->view('emails.alerta-suscripcion');
    }
}
