<x-card>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-medium text-gray-900">Activités Récentes</h2>
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Voir tout</a>
        </div>
    </x-slot>

    <div class="flow-root">
        <ul role="list" class="-mb-8">
            @forelse($recentActivities as $activity)
                <li>
                    <div class="relative pb-8">
                        @if (!$loop->last)
                            <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="flex h-8 w-8 items-center justify-center rounded-full {{ $activity->type === 'completed' ? 'bg-green-500' : 'bg-indigo-500' }} text-white ring-8 ring-white">
                                    <i class="fas {{ $activity->type === 'completed' ? 'fa-check' : 'fa-plus' }} text-sm"></i>
                                </span>
                            </div>
                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                <div>
                                    <p class="text-sm text-gray-500">{{ $activity->description }}</p>
                                </div>
                                <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                    <time datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="text-center py-4 text-gray-500">
                    Aucune activité récente
                </li>
            @endforelse
        </ul>
    </div>
</x-card>