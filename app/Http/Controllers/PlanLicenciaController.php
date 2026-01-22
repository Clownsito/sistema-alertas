<?php

namespace App\Http\Controllers;

use App\Models\PlanLicencia;
use Illuminate\Http\Request;

class PlanLicenciaController extends Controller
{
    public function index()
    {
        $planes = PlanLicencia::orderBy('created_at', 'desc')->get();

        return view('planes_licencias.index', compact('planes'));
    }

    public function create()
    {
        return view('planes_licencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad_licencias' => 'required|integer|min:1',
            'precio' => 'required|integer|min:0',
            'activo' => 'required|boolean',
        ]);

        PlanLicencia::create([
            'nombre' => $request->nombre,
            'cantidad_licencias' => $request->cantidad_licencias,
            'precio' => $request->precio,
            'activo' => $request->activo,
        ]);

        return redirect()
            ->route('planes-licencias.index')
            ->with('success', 'Plan de licencia creado correctamente');
    }

    public function edit(PlanLicencia $planes_licencia)
    {
        return view('planes_licencias.edit', [
            'plan' => $planes_licencia
        ]);
    }

    public function update(Request $request, PlanLicencia $planes_licencia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad_licencias' => 'required|integer|min:1',
            'precio' => 'required|integer|min:0',
            'activo' => 'required|boolean',
        ]);

        $planes_licencia->update([
            'nombre' => $request->nombre,
            'cantidad_licencias' => $request->cantidad_licencias,
            'precio' => $request->precio,
            'activo' => $request->activo,
        ]);

        return redirect()
            ->route('planes-licencias.index')
            ->with('success', 'Plan de licencia actualizado');
    }

    public function destroy(PlanLicencia $planes_licencia)
    {
        $planes_licencia->delete();

        return redirect()
            ->route('planes-licencias.index')
            ->with('success', 'Plan de licencia eliminado');
    }
}
