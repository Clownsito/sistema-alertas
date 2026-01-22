<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva Suscripción
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('suscripciones.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Cliente</label>
                        <select name="cliente_id"
                                class="w-full border rounded px-3 py-2"
                                required>
                            <option value="">-- Seleccionar cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->empresa }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Plan de Licencia</label>
                        <select name="plan_licencia_id"
                                class="w-full border rounded px-3 py-2"
                                required>
                            <option value="">-- Seleccionar plan --</option>
                            @foreach($planes as $plan)
                                <option value="{{ $plan->id }}"
                                    {{ old('plan_licencia_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Fecha Inicio</label>
                        <input type="date"
                               name="fecha_inicio"
                               value="{{ old('fecha_inicio') }}"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Fecha Fin</label>
                        <input type="date"
                               name="fecha_fin"
                               value="{{ old('fecha_fin') }}"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="activa" value="0">
                            <input type="checkbox"
                                   name="activa"
                                   value="1"
                                   {{ old('activa', true) ? 'checked' : '' }}
                                   class="rounded">
                            <span class="ml-2">Activa</span>
                        </label>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('suscripciones.index') }}"
                           class="px-4 py-2 bg-gray-300 rounded">
                            Cancelar
                        </a>

                        <button
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Guardar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
