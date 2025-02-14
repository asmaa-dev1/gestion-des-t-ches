<x-app-layout>
    @section('header')
        Tableau de Bord
    @endsection

    @section('content')
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @include('dashboard._stats')
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="grid gap-6">
                @include('dashboard._recent-activity')
                @include('dashboard._project-stats')
            </div>
            <div>
                @include('dashboard._overview')
            </div>
        </div>
    @endsection
</x-app-layout>
