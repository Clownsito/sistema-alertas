<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanLicencia extends Model
{
    use HasFactory;

    protected $table = 'planes_licencias';

    protected $fillable = [
        'nombre',
        'cantidad_licencias',
        'precio',
        'activa',
    ];

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class);
    }
}
