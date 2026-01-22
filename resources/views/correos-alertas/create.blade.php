<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Nuevo correo de alerta
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form method="POST"
              action="{{ route('correos-alertas.store') }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

            @csrf

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIVO --}}
            <div class="mb-6 flex items-center gap-2">
                <input type="checkbox"
                       name="activo"
                       value="1"
                       checked>
                <label>Activo</label>
            </div>

            {{-- BOTONES --}}
            <div class="flex gap-4">
                <a href="{{ route('correos-alertas.index') }}"
                   class="text-gray-500 hover:underline">
                    Cancelar
                </a>

                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
