<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Correos de Alertas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            {{-- MENSAJE --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- BOTÓN NUEVO --}}
            <div class="mb-6">
                <a href="{{ route('correos-alertas.create') }}"
                   class="text-blue-500 hover:underline">
                    + Nuevo correo
                </a>
            </div>

            {{-- TABLA --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">
                                Activo
                            </th>
                            <th class="px-6 py-3 text-right text-sm font-semibold">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($correos as $correo)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $correo->email }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($correo->activo)
                                        <span class="text-green-600 font-semibold">
                                            Activo
                                        </span>
                                    @else
                                        <span class="text-red-500 font-semibold">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('correos-alertas.edit', $correo) }}"
                                       class="text-blue-500 hover:underline">
                                        Editar
                                    </a>

                                    <form action="{{ route('correos-alertas.destroy', $correo) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('¿Eliminar este correo?')"
                                            class="text-red-500 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"
                                    class="px-6 py-6 text-center text-gray-500">
                                    No hay correos configurados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
