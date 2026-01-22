<?php

namespace App\Http\Controllers;

use App\Models\CorreoAlerta;
use Illuminate\Http\Request;

class CorreoAlertaController extends Controller
{
    public function index()
    {
        $correos = CorreoAlerta::orderBy('created_at', 'desc')->get();
        return view('correos-alertas.index', compact('correos'));
    }

    public function create()
    {
        return view('correos-alertas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:correos_alertas,email',
            'activo' => 'nullable|boolean',
        ]);

        CorreoAlerta::create([
            'email' => $request->email,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()
            ->route('correos-alertas.index')
            ->with('success', 'Correo agregado correctamente.');
    }

    public function edit(CorreoAlerta $correos_alerta)
    {
        return view('correos-alertas.edit', compact('correos_alerta'));
    }

    public function update(Request $request, CorreoAlerta $correos_alerta)
    {
        $request->validate([
            'email' => 'required|email|unique:correos_alertas,email,' . $correos_alerta->id,
            'activo' => 'nullable|boolean',
        ]);

        $correos_alerta->update([
            'email' => $request->email,
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()
            ->route('correos-alertas.index')
            ->with('success', 'Correo actualizado correctamente.');
    }

    public function destroy(CorreoAlerta $correos_alerta)
    {
        $correos_alerta->delete();

        return redirect()
            ->route('correos-alertas.index')
            ->with('success', 'Correo eliminado.');
    }

    public function toggleActivo(CorreoAlerta $correo)
    {
        $correo->update([
            'activo' => ! $correo->activo,
        ]);

        return redirect()
            ->route('correos-alertas.index')
            ->with('success', 'Estado del correo actualizado.');
    }
}
