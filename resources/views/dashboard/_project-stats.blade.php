<x-card>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-900">État des Projets</h2>
    </x-slot>

    <div class="space-y-4">
        @foreach($projects as $project)
            <div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-gray-900">{{ $project->title }}</span>
                        <span class="ml-2 px-2 py-1 text-xs font-medium {{ $project->status === 'Completed' ? 'bg-green-100 text-green-700' : 'bg-indigo-100 text-indigo-700' }} rounded-full">
                            {{ $project->status }}
                        </span>
                    </div>
                    <span class="text-sm text-gray-500">{{ $project->completion_rate }}%</span>
                </div>
                <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $project->completion_rate }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</x-card>