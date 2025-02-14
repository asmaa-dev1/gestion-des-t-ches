<x-card class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white">
    <div class="flex items-center">
        <div class="flex-shrink-0 rounded-md bg-indigo-800 p-3">
            <i class="fas fa-tasks fa-lg"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-sm font-medium">Tâches totales</h3>
            <p class="mt-1 text-2xl font-semibold">{{ $totalTasks }}</p>
        </div>
    </div>
</x-card>

<x-card class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white">
    <div class="flex items-center">
        <div class="flex-shrink-0 rounded-md bg-emerald-800 p-3">
            <i class="fas fa-check-circle fa-lg"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-sm font-medium">Tâches terminées</h3>
            <p class="mt-1 text-2xl font-semibold">{{ $completedTasks }}</p>
        </div>
    </div>
</x-card>

<x-card class="bg-gradient-to-br from-amber-500 to-amber-600 text-white">
    <div class="flex items-center">
        <div class="flex-shrink-0 rounded-md bg-amber-800 p-3">
            <i class="fas fa-project-diagram fa-lg"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-sm font-medium">Projets actifs</h3>
            <p class="mt-1 text-2xl font-semibold">{{ $activeProjects }}</p>
        </div>
    </div>
</x-card>

<x-card class="bg-gradient-to-br from-rose-500 to-rose-600 text-white">
    <div class="flex items-center">
        <div class="flex-shrink-0 rounded-md bg-rose-800 p-3">
            <i class="fas fa-clock fa-lg"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-sm font-medium">Tâches en retard</h3>
            <p class="mt-1 text-2xl font-semibold">{{ $overdueTasks }}</p>
        </div>
    </div>
</x-card>