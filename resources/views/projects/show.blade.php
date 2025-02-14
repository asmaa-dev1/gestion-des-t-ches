<x-app-layout>
    @section('header')
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $project->title }}</h1>
                <p class="mt-1 text-sm text-gray-500">Créé le {{ $project->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier
                </a>
                <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md">
                    <i class="fas fa-plus mr-2"></i>
                    Nouvelle Tâche
                </a>
            </div>
        </div>
    @endsection

    @section('content')
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-6">
                <x-card>
                    <div class="prose max-w-none">
                        <h3>Description</h3>
                        <p>{{ $project->description ?: 'Aucune description' }}</p>
                    </div>
                </x-card>

                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-medium text-gray-900">Tâches</h2>
                            <span class="inline-flex items-center rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800">
                                {{ $project->tasks->count() }} tâches
                            </span>
                        </div>
                    </x-slot>

                    @include('tasks._task-list', ['tasks' => $project->tasks])
                </x-card>
            </div>

            <div class="space-y-6">
                @include('projects._stats', ['project' => $project])
                
                <x-card>
                    <x-slot name="header">
                        <h2 class="text-lg font-medium text-gray-900">Activité Récente</h2>
                    </x-slot>

                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach($project->recentActivities as $activity)
                                <li>
                                    <div class="relative pb-8">
                                        @if (!$loop->last)
                                            <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500 ring-8 ring-white">
                                                <i class="fas fa-check text-white"></i>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                                                </div>
                                                <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                                    <time datetime="{{ $activity->created_at }}">
                                                        {{ $activity->created_at->diffForHumans() }}
                                                    </time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </x-card>
            </div>
        </div>
    @endsection
</x-app-layout>