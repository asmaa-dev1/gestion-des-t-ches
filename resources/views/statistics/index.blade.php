<x-app-layout>
    @section('header')
        <h1 class="text-2xl font-bold text-gray-900">Statistiques et Rapports</h1>
    @endsection

    @section('content')
        <div class="space-y-6">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <x-card class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-indigo-800 p-3">
                            <i class="fas fa-project-diagram fa-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium">Projets Totaux</h3>
                            <p class="mt-1 text-2xl font-semibold">{{ $statistics['total_projects'] }}</p>
                        </div>
                    </div>
                </x-card>

                <x-card class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 rounded-md bg-emerald-800 p-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium">Projets Terminés</h3>
                            <p class="mt-1 text-2xl font-semibold">{{ $statistics['completed_projects'] }}</p>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Priority Distribution -->
                <x-card>
                    <x-slot name="header">
                        <h2 class="text-lg font-medium text-gray-900">Distribution des Priorités</h2>
                    </x-slot>
                    <div class="h-64">
                        <canvas id="priorityChart"></canvas>
                    </div>
                </x-card>

                <!-- Status Distribution -->
                <x-card>
                    <x-slot name="header">
                        <h2 class="text-lg font-medium text-gray-900">État des Tâches</h2>
                    </x-slot>
                    <div class="h-64">
                        <canvas id="statusChart"></canvas>
                    </div>
                </x-card>
            </div>

            <!-- Completion Trend -->
            <x-card>
                <x-slot name="header">
                    <h2 class="text-lg font-medium text-gray-900">Tendance de Complétion</h2>
                </x-slot>
                <div class="h-96">
                    <canvas id="trendChart"></canvas>
                </div>
            </x-card>

            <!-- Category Distribution -->
            <x-card>
                <x-slot name="header">
                    <h2 class="text-lg font-medium text-gray-900">Distribution par Catégorie</h2>
                </x-slot>
                <div class="h-64">
                    <canvas id="categoryChart"></canvas>
                </div>
            </x-card>
        </div>

        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <script>
            // Priority Chart
            new Chart(document.getElementById('priorityChart'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($statistics['tasks_by_priority']->pluck('priority')) !!},
                    datasets: [{
                        data: {!! json_encode($statistics['tasks_by_priority']->pluck('count')) !!},
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
                    }]
                }
            });

            // Status Chart
            new Chart(document.getElementById('statusChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statistics['tasks_by_status']->pluck('status')) !!},
                    datasets: [{
                        data: {!! json_encode($statistics['tasks_by_status']->pluck('count')) !!},
                        backgroundColor: '#6366F1'
                    }]
                }
            });

            // Trend Chart
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($statistics['completion_trend']->pluck('month')) !!},
                    datasets: [{
                        label: 'Tâches Complétées',
                        data: {!! json_encode($statistics['completion_trend']->pluck('count')) !!},
                        borderColor: '#6366F1',
                        tension: 0.3
                    }]
                }
            });

            // Category Chart
            new Chart(document.getElementById('categoryChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($statistics['category_distribution']->pluck('category.name')) !!},
                    datasets: [{
                        data: {!! json_encode($statistics['category_distribution']->pluck('count')) !!},
                        backgroundColor: {!! json_encode($statistics['category_distribution']->pluck('category.color')) !!}
                    }]
                }
            });
        </script>
        @endpush
    @endsection
</x-app-layout>
