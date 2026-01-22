<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaEnviada extends Model
{
    use HasFactory;

    protected $table = 'alertas_enviadas';

    protected $fillable = [
        'suscripcion_id',
        'tipo_alerta',
        'fecha_alerta',
    ];
}
