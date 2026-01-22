<nav class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="text-white font-semibold text-lg">
                    Sistema de Alertas
                </a>
            </div>

            {{-- LINKS --}}
            <div class="hidden sm:flex sm:items-center">
                <div class="flex items-center gap-6">

                    <a href="{{ route('dashboard') }}"
                       class="text-gray-300 hover:text-white">
                        Dashboard
                    </a>

                    <a href="{{ route('clientes.index') }}"
                       class="text-gray-300 hover:text-white">
                        Clientes
                    </a>

                    <a href="{{ route('planes-licencias.index') }}"
                       class="text-gray-300 hover:text-white">
                        Licencias
                    </a>

                    <a href="{{ route('suscripciones.index') }}"
                       class="text-gray-300 hover:text-white">
                        Suscripciones
                    </a>

                    <a href="{{ route('correos-alertas.index') }}"
                       class="text-gray-300 hover:text-white">
                        Correos
                    </a>

                </div>
            </div>

            {{-- USER / TOGGLE --}}
            <div class="flex items-center gap-4">

                {{-- DARK / LIGHT --}}
                <button
                    id="theme-toggle"
                    class="text-gray-300 hover:text-yellow-400 text-xl transition"
                    title="Cambiar tema">
                    🌙
                </button>

                <span class="text-gray-300">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-400 hover:text-red-300">
                        Salir
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>

{{-- SCRIPT DARK/LIGHT --}}
<script>
    const toggleBtn = document.getElementById('theme-toggle');
    const root = document.documentElement;

    // Al cargar
    if (localStorage.theme === 'dark') {
        root.classList.add('dark');
        toggleBtn.textContent = '☀️';
    } else {
        toggleBtn.textContent = '🌙';
    }

    toggleBtn.addEventListener('click', () => {
        if (root.classList.contains('dark')) {
            root.classList.remove('dark');
            localStorage.theme = 'light';
            toggleBtn.textContent = '🌙';
        } else {
            root.classList.add('dark');
            localStorage.theme = 'dark';
            toggleBtn.textContent = '☀️';
        }
    });
</script>
