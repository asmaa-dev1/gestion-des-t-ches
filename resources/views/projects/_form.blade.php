<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <x-form-input
            name="title"
            label="Titre du projet"
            :value="old('title', $project->title)"
            required
            autofocus
            :error="$errors->first('title')"
        />
    </div>

    <div>
        <x-form-textarea
            name="description"
            label="Description"
            :value="old('description', $project->description)"
            rows="4"
            :error="$errors->first('description')"
        >{{ old('description', $project->description) }}</x-form-textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Statut</label>
        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="Active" {{ old('status', $project->status) === 'Active' ? 'selected' : '' }}>En cours</option>
            <option value="Completed" {{ old('status', $project->status) === 'Completed' ? 'selected' : '' }}>Terminé</option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end space-x-3">
        <x-button variant="secondary" type="button" onclick="window.history.back()">
            Annuler
        </x-button>
        <x-button variant="secondary" type="submit">
            {{ $project->exists ? 'Mettre à jour' : 'Créer le projet' }}
        </x-button>
    </div>
</form>