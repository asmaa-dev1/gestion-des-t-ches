<x-app-layout>
    @section('header')
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Mes Projets</h1>
                <p class="mt-1 text-sm text-gray-500">Gérez et suivez vos projets en cours</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('projects.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium rounded-md shadow-sm transition-all duration-150 ease-in-out hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Nouveau Projet
                </a>
            </div>
        </div>
    @endsection

    @section('content')
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600">
                                <i class="fas fa-folder text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Projets</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $projects->total() }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600">
                                <i class="fas fa-check-circle text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Projets Actifs</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">
                                        {{ $projects->where('status', 'Active')->count() }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 grid gap-4 md:flex md:items-center md:justify-between">
            <!-- Search -->
            <div class="relative rounded-md shadow-sm max-w-md">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" 
                       name="search" 
                       class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                       placeholder="Rechercher un projet...">
            </div>

            <!-- Filters -->
            <div class="flex flex-wrap items-center gap-3">
                <select class="rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option>Tous les statuts</option>
                    <option>Actifs</option>
                    <option>Terminés</option>
                </select>

                <select class="rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option>Trier par</option>
                    <option>Plus récents</option>
                    <option>Plus anciens</option>
                    <option>Alphabétique</option>
                </select>

                <button type="button" 
                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-filter mr-2"></i>
                    Filtres
                </button>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($projects as $project)
                <div class="group relative bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600">
                                    {{ $project->title }}
                                </a>
                            </h3>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $project->status === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}">
                                {{ $project->status }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 mb-4">{{ Str::limit($project->description, 100) }}</p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-tasks mr-1.5"></i>
                                    {{ $project->tasks_count ?? 0 }} tâches
                                </span>
                                <span class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    {{ $project->completed_tasks_count ?? 0 }} terminées
                                </span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <a href="{{ route('projects.edit', $project) }}" 
                                   class="text-gray-400 hover:text-gray-500 p-1 hover:bg-gray-100 rounded-full transition-colors duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-gray-400 hover:text-red-500 p-1 hover:bg-gray-100 rounded-full transition-colors duration-200"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                        <i class="fas fa-folder-open text-gray-400 text-5xl mb-4"></i>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Aucun projet</h3>
                        <p class="mt-1 text-sm text-gray-500">Commencez par créer votre premier projet</p>
                        <div class="mt-6">
                        <a href="{{ route('projects.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium rounded-md shadow-sm transition-all duration-150 ease-in-out hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Nouveau Projet
                </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
            <div class="mt-6 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                {{ $projects->links() }}
            </div>
        @endif
    @endsection
</x-app-layout>