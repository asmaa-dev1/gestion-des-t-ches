<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1">
    <!-- Progress Overview Card -->
    <x-card>
        <div class="p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Vue d'ensemble</h3>
            
            <div class="space-y-4">
                <!-- Progress Bar -->
                <div>
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Progression totale</span>
                        <span>{{ $project->tasks->count() > 0 
                            ? round(($project->tasks->where('status', 'Completed')->count() / $project->tasks->count()) * 100) 
                            : 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $project->tasks->count() > 0 
                            ? round(($project->tasks->where('status', 'Completed')->count() / $project->tasks->count()) * 100) 
                            : 0 }}%"></div>
                    </div>
                </div>

                <!-- Task Stats Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 text-indigo-600">
                                    <i class="fas fa-tasks text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-500">Total des tâches</h4>
                                <span class="text-2xl font-semibold text-gray-900">
                                    {{ $project->tasks->count() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-green-100 text-green-600">
                                    <i class="fas fa-check-circle text-lg"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-500">Tâches terminées</h4>
                                <span class="text-2xl font-semibold text-gray-900">
                                    {{ $project->tasks->where('status', 'Completed')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    <!-- Project Details Card -->
    <x-card>
        <div class="p-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Détails du projet</h3>
            
            <div class="space-y-4">
                <!-- Status -->
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Statut</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                        $project->status === 'Completed' 
                            ? 'bg-green-100 text-green-800' 
                            : 'bg-indigo-100 text-indigo-800' 
                    }}">
                        {{ $project->status === 'Completed' ? 'Terminé' : 'En cours' }}
                    </span>
                </div>

                <!-- Dates -->
                <div class="border-t border-gray-200 pt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-500">Créé le</span>
                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $project->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Dernière modification</span>
                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ $project->updated_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Task Priority Distribution -->
                @if($project->tasks->count() > 0)
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-sm font-medium text-gray-500 mb-3">Distribution des priorités</h4>
                        <div class="space-y-2">
                            @php
                                $priorities = [
                                    'high' => ['label' => 'Haute', 'class' => 'bg-red-100 text-red-800'],
                                    'medium' => ['label' => 'Moyenne', 'class' => 'bg-yellow-100 text-yellow-800'],
                                    'low' => ['label' => 'Basse', 'class' => 'bg-green-100 text-green-800']
                                ];
                            @endphp

                            @foreach($priorities as $priority => $data)
                                @php
                                    $count = $project->tasks->where('priority', $priority)->count();
                                    $percentage = $project->tasks->count() > 0 
                                        ? round(($count / $project->tasks->count()) * 100) 
                                        : 0;
                                @endphp
                                
                                <div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $data['class'] }}">
                                            {{ $data['label'] }}
                                        </span>
                                        <span class="text-gray-500">{{ $count }} tâches</span>
                                    </div>
                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full {{ str_replace('text', 'bg', $data['class']) }}" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-card>
</div>