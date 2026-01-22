<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;

    // 🔥 CLAVE: forzar nombre correcto de la tabla
    protected $table = 'suscripciones';

    protected $fillable = [
        'cliente_id',
        'plan_licencia_id',
        'fecha_inicio',
        'fecha_fin',
        'activa',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function planLicencia()
    {
        return $this->belongsTo(PlanLicencia::class);
    }

}
