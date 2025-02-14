<x-card class="h-full">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-medium text-gray-900">Aperçu des Tâches</h2>
            <div class="flex space-x-3">
                <select class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Cette semaine</option>
                    <option>Ce mois</option>
                    <option>Cette année</option>
                </select>
            </div>
        </div>
    </x-slot>

    <div class="mt-4 space-y-6">
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-900">Tâches prioritaires</h3>
            @forelse($priorityTasks as $task)
                <div class="group relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-5 py-4 shadow-sm hover:border-gray-400">
                    <div class="min-w-0 flex-1">
                        <a href="{{ route('projects.tasks.edit', [$task->project_id, $task->id]) }}" class="focus:outline-none">
                            <p class="text-sm font-medium text-gray-900">{{ $task->title }}</p>
                            <p class="truncate text-sm text-gray-500">{{ $task->project->title }}</p>
                        </a>
                    </div>
                    <span class="inline-flex flex-shrink-0 items-center rounded-full bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20">
                        Prioritaire
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-500">Aucune tâche prioritaire</p>
            @endforelse
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-900 mb-4">Répartition des tâches</h3>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="rounded-md bg-indigo-50 p-4">
                    <dt class="text-sm font-medium text-indigo-600">À faire</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-indigo-900">{{ $todoCount }}</dd>
                </div>
                <div class="rounded-md bg-yellow-50 p-4">
                    <dt class="text-sm font-medium text-yellow-600">En cours</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-yellow-900">{{ $inProgressCount }}</dd>
                </div>
                <div class="rounded-md bg-green-50 p-4">
                    <dt class="text-sm font-medium text-green-600">Terminées</dt>
                    <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-900">{{ $completedCount }}</dd>
                </div>
            </div>
        </div>
    </div>
</x-card>