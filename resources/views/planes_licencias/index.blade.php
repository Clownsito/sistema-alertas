<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planes de Licencia
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('planes-licencias.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Nuevo Plan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Cantidad</th>
                            <th class="px-4 py-2 text-left">Precio</th>
                            <th class="px-4 py-2 text-left">Activo</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($planes as $plan)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $plan->nombre }}</td>
                                <td class="px-4 py-2">
                                    {{ $plan->cantidad_licencias }}
                                </td>
                                <td class="px-4 py-2">
                                    ${{ number_format($plan->precio, 0, ',', '.') }}
                                </td>

                                {{-- 🔁 TOGGLE ACTIVO --}}
                                <td class="px-4 py-2">
                                    <form
                                        method="POST"
                                        action="{{ route('planes-licencias.toggle', $plan) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="px-3 py-1 rounded text-white
                                                {{ $plan->activo ? 'bg-green-600' : 'bg-gray-500' }}">
                                            {{ $plan->activo ? 'Activo' : 'Inactivo' }}
                                        </button>
                                    </form>
                                </td>

                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('planes-licencias.edit', $plan) }}"
                                       class="text-blue-600 hover:underline">
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('planes-licencias.destroy', $plan) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar este plan?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-4 py-4 text-center text-gray-500">
                                    No hay planes de licencia registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
