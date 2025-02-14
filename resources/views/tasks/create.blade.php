<x-app-layout>
    @section('header')
        <div class="flex items-center">
            <a href="{{ route('projects.show', $project) }}" class="mr-2 text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Nouvelle Tâche - {{ $project->title }}</h1>
        </div>
    @endsection

    @section('content')
        <div class="max-w-2xl mx-auto">
            <x-card>
                @include('tasks._task-form', [
                    'action' => route('projects.tasks.store', $project),
                    'method' => 'POST',
                    'task' => new App\Models\Task
                ])
            </x-card>
        </div>
    @endsection
</x-app-layout>