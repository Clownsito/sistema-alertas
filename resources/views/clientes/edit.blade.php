<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Editar Cliente
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <form method="POST"
                  action="{{ route('clientes.update', $cliente) }}"
                  class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium">Empresa</label>
                    <input type="text" name="empresa"
                           value="{{ $cliente->empresa }}"
                           class="w-full rounded border-gray-300"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Correo</label>
                    <input type="email" name="correo"
                           value="{{ $cliente->correo }}"
                           class="w-full rounded border-gray-300"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium">
                        Fecha vencimiento contrato
                    </label>
                    <input type="date" name="fecha_vencimiento"
                           value="{{ $cliente->fecha_vencimiento }}"
                           class="w-full rounded border-gray-300"
                           required>
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="activo" value="1"
                            {{ $cliente->activo ? 'checked' : '' }}>
                        <span class="ml-2">Cliente activo</span>
                    </label>
                </div>

                <div class="flex justify-between">
                    <form method="POST"
                          action="{{ route('clientes.destroy', $cliente) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">
                            Eliminar
                        </button>
                    </form>

                    <div class="space-x-2">
                        <a href="{{ route('clientes.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Guardar cambios
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
