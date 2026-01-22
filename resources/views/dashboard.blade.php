<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 space-y-10">

            <!-- KPI CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @php
                    $cards = [
                        ['Clientes', $totalClientes],
                        ['Planes', $totalPlanes],
                        ['Planes activos', $planesActivos],
                        ['Suscripciones', $totalSuscripciones],
                    ];
                @endphp

                @foreach ($cards as [$label, $value])
                    <div
                        class="bg-gray-800 rounded-xl p-6 shadow transition transform hover:-translate-y-1 hover:shadow-2xl">
                        <p class="text-gray-400 text-sm">{{ $label }}</p>
                        <p class="text-4xl font-bold text-white mt-2">{{ $value }}</p>
                    </div>
                @endforeach

                <div
                    class="bg-red-900 rounded-xl p-6 shadow transition transform hover:-translate-y-1 hover:shadow-2xl">
                    <p class="text-red-300 text-sm">Por vencer (7 días)</p>
                    <p class="text-4xl font-bold text-white mt-2">
                        {{ $suscripcionesPorVencer }}
                    </p>
                </div>
            </div>

            <!-- ALERTA -->
            @if ($suscripcionesPorVencer > 0)
                <div class="bg-yellow-900 border border-yellow-700 text-yellow-200 p-4 rounded-lg">
                    ⚠️ Hay {{ $suscripcionesPorVencer }} suscripciones próximas a vencer.
                </div>
            @endif

            <!-- GRAFICO -->
            <div class="bg-gray-800 rounded-xl p-6 shadow">
                <h3 class="text-lg font-semibold text-white mb-4">
                    Suscripciones por mes
                </h3>

                <canvas id="suscripcionesChart" height="100"></canvas>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('suscripcionesChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(
                    collect($suscripcionesPorMes->keys())->map(fn($m) =>
                        \Carbon\Carbon::create()->month($m)->translatedFormat('F')
                    )
                ) !!},
                datasets: [{
                    label: 'Suscripciones',
                    data: {!! json_encode($suscripcionesPorMes->values()) !!},
                    borderColor: '#22d3ee',
                    backgroundColor: 'rgba(34, 211, 238, 0.2)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: { color: '#e5e7eb' }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#9ca3af' }
                    },
                    y: {
                        ticks: { color: '#9ca3af' }
                    }
                }
            }
        });
    </script>
</x-app-layout>
