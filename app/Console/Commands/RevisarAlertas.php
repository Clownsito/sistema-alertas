<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Suscripcion;
use App\Models\AlertaEnviada;
use App\Mail\AlertaSuscripcionMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RevisarAlertas extends Command
{
    protected $signature = 'app:revisar-alertas';

    protected $description = 'Revisa suscripciones y envía alertas de vencimiento';

    public function handle()
    {
        $hoy = Carbon::today()->toDateString();

        $suscripciones = Suscripcion::with(['cliente', 'planLicencia'])
            ->where('activa', 1)
            ->get();

        if ($suscripciones->isEmpty()) {
            $this->info('No hay suscripciones activas.');
            return;
        }

        // 👉 obtener todos los correos activos
        $correos = CorreoAlerta::where('activo', 1)->pluck('email');
            Mail::to($correos)
             ->send(new AlertaSuscripcionMail($suscripcion, $tipo));
        foreach ($suscripciones as $suscripcion) {

            $fechaFin = Carbon::parse($suscripcion->fecha_fin);

            $alertas = [
                '3_dias'      => $fechaFin->copy()->subDays(3)->toDateString(),
                '1_dia'       => $fechaFin->copy()->subDay()->toDateString(),
                'vencimiento' => $fechaFin->toDateString(),
            ];

            foreach ($alertas as $tipo => $fechaAlerta) {

                if ($fechaAlerta === $hoy) {

                    $yaEnviada = AlertaEnviada::where('suscripcion_id', $suscripcion->id)
                        ->where('tipo_alerta', $tipo)
                        ->exists();

                    if (! $yaEnviada) {

                        AlertaEnviada::create([
                            'suscripcion_id' => $suscripcion->id,
                            'tipo_alerta'    => $tipo,
                            'fecha_alerta'   => $hoy,
                        ]);

                        // 👉 enviar a TODOS los correos activos
                        foreach ($correos as $email) {
                            Mail::to($email)
                                ->send(new AlertaSuscripcionMail($suscripcion, $tipo));
                        }
                    }
                }
            }
        }

        $this->info('Revisión de alertas completada.');
    }
}
