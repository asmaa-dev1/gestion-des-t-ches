<div class="mt-4 sm:flex sm:items-center sm:space-x-4">
    <div class="flex items-center space-x-2">
        <span class="text-sm font-medium text-gray-700">Filtrer par:</span>
        <select
            onchange="this.form.submit()"
            form="filter-form"
            name="status"
            class="rounded-md border-gray-300 py-1.5 text-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">Tous les statuts</option>
            <option value="Active" {{ request('status') === 'Active' ? 'selected' : '' }}>En cours</option>
            <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Terminé</option>
        </select>

        <select
            onchange="this.form.submit()"
            form="filter-form"
            name="priority"
            class="rounded-md border-gray-300 py-1.5 text-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="">Toutes les priorités</option>
            <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Basse</option>
            <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Moyenne</option>
            <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>Haute</option>
        </select>
    </div>

    <form id="filter-form" method="GET" class="hidden">
        @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
    </form>
</div>
