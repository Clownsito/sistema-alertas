<?php

namespace App\Http\Controllers;

use App\Models\CorreoAlerta;
use Illuminate\Http\Request;

class CorreoAlertaController extends Controller
{
    public function index()
    {
        $correos = CorreoAlerta::all();
        return view('correos-alertas.index', compact('correos'));
    }

    public function create()
    {
        return view('correos-alertas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'activo' => 'required|boolean',
        ]);

        CorreoAlerta::create($request->all());

        return redirect()->route('correos-alertas.index');
    }

    public function edit(CorreoAlerta $correos_alerta)
    {
        return view('correos-alertas.edit', compact('correos_alerta'));
    }

    public function update(Request $request, CorreoAlerta $correos_alerta)
    {
        $request->validate([
            'email' => 'required|email',
            'activo' => 'required|boolean',
        ]);

        $correos_alerta->update($request->all());

        return redirect()->route('correos-alertas.index');
    }

    public function destroy(CorreoAlerta $correos_alerta)
    {
        $correos_alerta->delete();
        return redirect()->route('correos-alertas.index');
    }
}
