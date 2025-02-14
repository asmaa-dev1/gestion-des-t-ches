<x-app-layout>
    @section('header')
        <h1 class="text-2xl font-bold text-gray-900">Nouveau Projet</h1>
    @endsection

    @section('content')
        <x-card class="max-w-2xl mx-auto">
            @include('projects._form', [
                'action' => route('projects.store'),
                'method' => 'POST',
                'project' => new App\Models\Project
            ])
        </x-card>
    @endsection
</x-app-layout>