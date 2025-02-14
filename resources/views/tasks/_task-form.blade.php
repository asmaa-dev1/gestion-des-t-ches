<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <x-form-input
            name="title"
            label="Titre de la tâche"
            :value="old('title', $task->title)"
            required
            autofocus
            :error="$errors->first('title')"
        />
    </div>

    <div>
        <x-form-textarea
            name="description"
            label="Description"
            rows="4"
            :error="$errors->first('description')"
        >{{ old('description', $task->description) }}</x-form-textarea>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <div>
            <label class="block text-sm font-medium text-gray-700">Priorité</label>
            <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Basse</option>
                <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Moyenne</option>
                <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>Haute</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>À faire</option>
                <option value="In Progress" {{ old('status', $task->status) === 'In Progress' ? 'selected' : '' }}>En cours</option>
                <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>Terminée</option>
            </select>
        </div>
    </div>

    <div>
        <x-form-input
            type="date"
            name="due_date"
            label="Date d'échéance"
            :value="old('due_date', $task->due_date?->format('Y-m-d'))"
            :error="$errors->first('due_date')"
        />
    </div>

    <div class="flex justify-end space-x-3">
        <x-button variant="secondary" type="button" onclick="window.history.back()">
            Annuler
        </x-button>
        <x-button type="submit">
            {{ $task->exists ? 'Mettre à jour' : 'Créer la tâche' }}
        </x-button>
    </div>
</form>
