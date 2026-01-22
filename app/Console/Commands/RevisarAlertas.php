<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Suscripcion;
use App\Models\AlertaEnviada;
use App\Models\CorreoAlerta;
use App\Mail\AlertaSuscripcionMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RevisarAlertas extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:revisar-alertas';

    /**
     * The console command description.
     */
    protected $description = 'Revisa suscripciones y envía alertas de vencimiento';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hoy = Carbon::today()->toDateString();

        // Obtener suscripciones activas con relaciones
        $suscripciones = Suscripcion::with(['cliente', 'planLicencia'])
            ->where('activa', true)
            ->get();

        if ($suscripciones->isEmpty()) {
            $this->info('No hay suscripciones activas.');
            return Command::SUCCESS;
        }

        // Obtener correos activos
        $correos = CorreoAlerta::where('activo', true)
            ->pluck('email')
            ->toArray();

        if (empty($correos)) {
            $this->warn('No hay correos activos para enviar alertas.');
            return Command::SUCCESS;
        }

        foreach ($suscripciones as $suscripcion) {

            $fechaFin = Carbon::parse($suscripcion->fecha_fin);

            $alertas = [
                '3_dias'      => $fechaFin->copy()->subDays(3)->toDateString(),
                '1_dia'       => $fechaFin->copy()->subDay()->toDateString(),
                'vencimiento' => $fechaFin->toDateString(),
            ];

            foreach ($alertas as $tipo => $fechaAlerta) {

                if ($fechaAlerta !== $hoy) {
                    continue;
                }

                $yaEnviada = AlertaEnviada::where([
                    'suscripcion_id' => $suscripcion->id,
                    'tipo_alerta'    => $tipo,
                ])->exists();

                if ($yaEnviada) {
                    continue;
                }

                // Registrar alerta enviada
                AlertaEnviada::create([
                    'suscripcion_id' => $suscripcion->id,
                    'tipo_alerta'    => $tipo,
                    'fecha_alerta'   => $hoy,
                ]);

                // Enviar correo a todos los destinatarios
                Mail::to($correos)
                    ->send(new AlertaSuscripcionMail($suscripcion, $tipo));

                $this->info(
                    "Alerta enviada ({$tipo}) para suscripción ID {$suscripcion->id}"
                );
            }
        }

        $this->info('Revisión de alertas completada.');

        return Command::SUCCESS;
    }
}
