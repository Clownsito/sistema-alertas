<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreoAlerta extends Model
{
    use HasFactory;

    protected $table = 'correos_alertas';

    protected $fillable = [
        'email',
        'activo',
    ];
}
