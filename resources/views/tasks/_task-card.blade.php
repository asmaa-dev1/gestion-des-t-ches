<div class="bg-white shadow rounded-lg p-4 space-y-3">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <form action="{{ route('projects.tasks.toggle', [$task->project, $task]) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="rounded-full h-5 w-5 flex items-center justify-center {{ $task->status === 'Completed' ? 'bg-green-500 text-white' : 'border-2 border-gray-300 hover:border-indigo-500' }}">
                    @if($task->status === 'Completed')
                        <i class="fas fa-check text-xs"></i>
                    @endif
                </button>
            </form>
            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $this->getPriorityClasses($task->priority) }}">
                {{ ucfirst($task->priority) }}
            </span>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('projects.tasks.edit', [$task->project, $task]) }}" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-edit"></i>
            </a>
        </div>
    </div>

    <div>
        <h4 class="text-sm font-medium {{ $task->status === 'Completed' ? 'text-gray-500 line-through' : 'text-gray-900' }}">
            {{ $task->title }}
        </h4>
        @if($task->description)
            <p class="mt-1 text-sm text-gray-500">{{ Str::limit($task->description, 100) }}</p>
        @endif
    </div>

    @if($task->due_date)
        <div class="flex items-center text-sm {{ $task->is_overdue ? 'text-red-600' : 'text-gray-500' }}">
            <i class="fas fa-calendar-alt mr-1.5"></i>
            {{ $task->due_date->format('d/m/Y') }}
        </div>
    @endif
</div>