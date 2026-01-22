<?php

namespace App\Http\Controllers;

use App\Models\Suscripcion;
use App\Models\Cliente;
use App\Models\PlanLicencia;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function index()
    {
        $suscripciones = Suscripcion::with(['cliente', 'planLicencia'])
            ->orderBy('fecha_fin', 'asc')
            ->get();

        return view('suscripciones.index', compact('suscripciones'));
    }

    public function create()
    {
        $clientes = Cliente::where('activo', true)
            ->orderBy('empresa')
            ->get();

        // 🔧 ACÁ ESTÁ LA CORRECCIÓN CLAVE
        $planes = PlanLicencia::where('activa', true)
            ->orderBy('nombre')
            ->get();

        return view('suscripciones.create', compact('clientes', 'planes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_licencia_id' => 'required|exists:planes_licencias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activa' => 'required|boolean',
        ]);

        Suscripcion::create([
            'cliente_id' => $request->cliente_id,
            'plan_licencia_id' => $request->plan_licencia_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->activa,
        ]);

        return redirect()
            ->route('suscripciones.index')
            ->with('success', 'Suscripción creada correctamente');
    }

    public function edit(Suscripcion $suscripcione)
    {
        $clientes = Cliente::where('activo', true)
            ->orderBy('empresa')
            ->get();

        $planes = PlanLicencia::where('activa', true)
            ->orderBy('nombre')
            ->get();

        return view('suscripciones.edit', [
            'suscripcion' => $suscripcione,
            'clientes' => $clientes,
            'planes' => $planes,
        ]);
    }

    public function update(Request $request, Suscripcion $suscripcione)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'plan_licencia_id' => 'required|exists:planes_licencias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activa' => 'required|boolean',
        ]);

        $suscripcione->update([
            'cliente_id' => $request->cliente_id,
            'plan_licencia_id' => $request->plan_licencia_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'activa' => $request->activa,
        ]);

        return redirect()
            ->route('suscripciones.index')
            ->with('success', 'Suscripción actualizada');
    }

    public function destroy(Suscripcion $suscripcione)
    {
        $suscripcione->delete();

        return redirect()
            ->route('suscripciones.index')
            ->with('success', 'Suscripción eliminada');
    }
}
