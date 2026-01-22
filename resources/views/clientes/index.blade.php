<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Clientes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('clientes.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Nuevo Cliente
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Empresa</th>
                            <th class="px-4 py-2 text-left">Correo</th>
                            <th class="px-4 py-2 text-left">Activo</th>
                            <th class="px-4 py-2 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($clientes as $cliente)
                            <tr>
                                <td class="px-4 py-2">{{ $cliente->empresa }}</td>
                                <td class="px-4 py-2">{{ $cliente->correo }}</td>
                                <td class="px-4 py-2">
                                    {{ $cliente->activo ? 'Sí' : 'No' }}
                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                       class="text-blue-600 hover:underline">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-4 py-4 text-center text-gray-500">
                                    No hay clientes registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>