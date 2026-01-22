<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Suscripciones
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('suscripciones.create') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Nueva Suscripción
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Empresa</th>
                            <th class="px-4 py-2 text-left">Plan</th>
                            <th class="px-4 py-2 text-left">Licencias</th>
                            <th class="px-4 py-2 text-left">Inicio</th>
                            <th class="px-4 py-2 text-left">Vencimiento</th>
                            <th class="px-4 py-2 text-left">Activa</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suscripciones as $suscripcion)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    {{ $suscripcion->cliente->empresa }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $suscripcion->planLicencia->nombre }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $suscripcion->planLicencia->cantidad_licencias }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $suscripcion->fecha_inicio }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $suscripcion->fecha_fin }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $suscripcion->activa ? 'Sí' : 'No' }}
                                </td>

                                <td class="px-4 py-2">
                                    <div class="flex items-center gap-3">
                                        {{-- EDITAR --}}
                                        <a href="{{ route('suscripciones.edit', $suscripcion) }}"
                                           class="text-blue-600 hover:underline font-medium">
                                            Editar
                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form method="POST"
                                              action="{{ route('suscripciones.destroy', $suscripcion) }}"
                                              onsubmit="return confirm('¿Eliminar esta suscripción?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="text-red-600 hover:underline font-medium cursor-pointer bg-transparent border-0 p-0">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-4 text-center text-gray-500">
                                    No hay suscripciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
