<x-card class="hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 transition-all">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-lg font-medium text-gray-900">
                <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600">
                    {{ $project->title }}
                </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">{{ Str::limit($project->description, 100) }}</p>
        </div>
        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $project->status === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-indigo-100 text-indigo-800' }}">
            {{ $project->status }}
        </span>
    </div>

    <div class="mt-6 border-t border-gray-100 pt-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-tasks mr-1.5"></i>
                    {{ $project->tasks_count }} tâches
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-check-circle mr-1.5"></i>
                    {{ $project->completed_tasks_count }} terminées
                </div>
            </div>
            
            <div class="flex items-center space-x-2">
                <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-card>