<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\PlanLicencia;
use App\Models\Suscripcion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();
        $en7Dias = Carbon::today()->addDays(7);

        $suscripcionesPorMes = Suscripcion::selectRaw('MONTH(fecha_fin) as mes, COUNT(*) as total')
            ->whereYear('fecha_fin', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        return view('dashboard', [
            'totalClientes' => Cliente::count(),
            'totalPlanes' => PlanLicencia::count(),
            'planesActivos' => PlanLicencia::where('activa', true)->count(),
            'totalSuscripciones' => Suscripcion::count(),
            'suscripcionesPorVencer' => Suscripcion::whereBetween('fecha_fin', [$hoy, $en7Dias])
                ->where('activa', true)
                ->count(),
            'suscripcionesPorMes' => $suscripcionesPorMes,
        ]);
    }
}
