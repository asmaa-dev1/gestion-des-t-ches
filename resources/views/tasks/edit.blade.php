<x-app-layout>
    @section('header')
        <div class="flex items-center">
            <a href="{{ route('projects.show', $task->project) }}" class="mr-2 text-indigo-600 hover:text-indigo-500">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Modifier la Tâche</h1>
        </div>
    @endsection

    @section('content')
        <div class="max-w-2xl mx-auto">
            <x-card>
                @include('tasks._task-form', [
                    'action' => route('projects.tasks.update', [$task->project, $task]),
                    'method' => 'PUT',
                    'task' => $task
                ])
            </x-card>
        </div>
    @endsection
</x-app-layout>