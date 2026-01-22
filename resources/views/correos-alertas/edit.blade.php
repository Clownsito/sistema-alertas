<x-app-layout>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-gray-800 p-6 rounded-lg shadow">

            <h2 class="text-xl font-semibold text-white mb-6">
                Editar correo de alerta
            </h2>

            <form method="POST"
                  action="{{ route('correos-alertas.update', $correos_alerta) }}">
                @csrf
                @method('PUT')

                {{-- EMAIL --}}
                <div class="mb-4">
                    <label class="block text-gray-300 mb-1">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $correos_alerta->email) }}"
                           required
                           class="w-full rounded bg-gray-900 text-white border border-gray-600 focus:border-cyan-500 focus:ring-cyan-500">
                </div>

                {{-- ACTIVO --}}
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox"
                               name="activo"
                               value="1"
                               {{ $correos_alerta->activo ? 'checked' : '' }}
                               class="rounded text-cyan-600">
                        <span class="ml-2 text-gray-300">Activo</span>
                    </label>
                </div>

                {{-- BOTONES --}}
                <div class="flex justify-between items-center">
                    <a href="{{ route('correos-alertas.index') }}"
                       class="text-gray-400 hover:text-white">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
