<x-app-layout>
    @section('header')
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Catégories</h1>
            <button 
                x-data=""
                x-on:click="$dispatch('open-modal', 'category-form')"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md"
            >
                <i class="fas fa-plus mr-2"></i>
                Nouvelle Catégorie
            </button>
        </div>
    @endsection

    @section('content')
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $category)
                <x-card>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 rounded-full" style="background-color: {{ $category->color }}"></div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                x-data=""
                                x-on:click="$dispatch('open-modal', 'edit-category-{{ $category->id }}')"
                                class="text-gray-400 hover:text-gray-500"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-gray-500">{{ $category->projects_count }} projets</span>
                    </div>
                </x-card>
            @endforeach
        </div>

        <!-- New Category Modal -->
        <x-modal name="category-form" :show="$errors->isNotEmpty()" focusable>
            <form method="POST" action="{{ route('categories.store') }}" class="p-6">
                @csrf

                <h2 class="text-lg font-medium text-gray-900">
                    Nouvelle Catégorie
                </h2>

                <div class="mt-6">
                    <x-form-input
                        name="name"
                        label="Nom de la catégorie"
                        :value="old('name')"
                        required
                        :error="$errors->first('name')"
                    />
                </div>

                <div class="mt-6">
                    <x-form-input
                        type="color"
                        name="color"
                        label="Couleur"
                        :value="old('color', '#6366F1')"
                        required
                        :error="$errors->first('color')"
                    />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-button variant="secondary" x-on:click="$dispatch('close')">
                        Annuler
                    </x-button>

                    <x-button class="ml-3">
                        Créer
                    </x-button>
                </div>
            </form>
        </x-modal>
    @endsection
</x-app-layout>