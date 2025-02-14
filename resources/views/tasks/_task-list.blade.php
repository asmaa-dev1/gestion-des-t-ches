<div class="divide-y divide-gray-200">
    @forelse($tasks as $task)
        <div class="py-4 flex items-center justify-between">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <form action="{{ route('projects.tasks.toggle', [$task->project, $task]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="rounded-full h-5 w-5 flex items-center justify-center {{ $task->status === 'Completed' ? 'bg-green-500 text-white' : 'border-2 border-gray-300 hover:border-indigo-500' }}">
                            @if($task->status === 'Completed')
                                <i class="fas fa-check text-xs"></i>
                            @endif
                        </button>
                    </form>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center space-x-2">
                        <h3 class="text-sm font-medium {{ $task->status === 'Completed' ? 'text-gray-500 line-through' : 'text-gray-900' }}">
                            {{ $task->title }}
                        </h3>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $task->getPriorityClasses() }}">
                        {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                    @if($task->description)
                        <p class="mt-1 text-sm text-gray-500">{{ Str::limit($task->description, 100) }}</p>
                    @endif
                    @if($task->due_date)
                        <p class="mt-1 text-sm {{ $task->is_overdue ? 'text-red-600' : 'text-gray-500' }}">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $task->due_date->format('d/m/Y') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <a href="{{ route('projects.tasks.edit', [$task->project, $task]) }}" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('projects.tasks.destroy', [$task->project, $task]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="py-4 text-center text-gray-500">
            Aucune tâche pour le moment
        </div>
    @endforelse
</div>