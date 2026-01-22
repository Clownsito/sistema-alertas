<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center text-white font-bold">
                Sistema de Alertas
            </div>

            <!-- Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6 text-sm text-gray-300">
                <a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a>
                <a href="{{ route('clientes.index') }}" class="hover:text-white">Clientes</a>
                <a href="{{ route('planes-licencias.index') }}" class="hover:text-white">Licencias</a>
                <a href="{{ route('suscripciones.index') }}" class="hover:text-white">Suscripciones</a>
                <a href="{{ route('correos-alertas.index') }}" class="hover:text-white">Correos</a>
                <a href="{{ route('alertas-enviadas.index') }}" class="hover:text-white">Alertas</a>
            </div>

            <!-- User dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm text-gray-300 hover:text-white">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="text-gray-400 hover:text-white">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden bg-gray-700 text-gray-200 px-4 py-2 space-y-2">
        <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
        <a href="{{ route('clientes.index') }}" class="block">Clientes</a>
        <a href="{{ route('planes-licencias.index') }}" class="block">Licencias</a>
        <a href="{{ route('suscripciones.index') }}" class="block">Suscripciones</a>
        <a href="{{ route('correos-alertas.index') }}" class="block">Correos</a>
        <a href="{{ route('alertas-enviadas.index') }}" class="block">Alertas</a>
    </div>
</nav>
