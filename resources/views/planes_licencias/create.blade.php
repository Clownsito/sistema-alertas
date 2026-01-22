<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Plan de Licencia
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

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

                <form method="POST" action="{{ route('planes-licencias.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Nombre</label>
                        <input
                            type="text"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            class="w-full border rounded px-3 py-2"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Cantidad de Licencias</label>
                        <input
                            type="number"
                            name="cantidad_licencias"
                            value="{{ old('cantidad_licencias') }}"
                            min="1"
                            class="w-full border rounded px-3 py-2"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Precio</label>
                        <input
                            type="number"
                            name="precio"
                            value="{{ old('precio') }}"
                            min="0"
                            class="w-full border rounded px-3 py-2"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="activo" value="0">
                            <input
                                type="checkbox"
                                name="activo"
                                value="1"
                                {{ old('activo') ? 'checked' : '' }}
                                class="rounded"
                            >
                            <span class="ml-2">Activo</span>
                        </label>
                    </div>

                    <div class="flex gap-2">
                        <a
                            href="{{ route('planes-licencias.index') }}"
                            class="px-4 py-2 bg-gray-300 rounded"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                        >
                            Guardar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
