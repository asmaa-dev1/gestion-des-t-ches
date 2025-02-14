<div class="text-center py-12">
    <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
    <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ $title }}</h3>
    <p class="mt-1 text-sm text-gray-500">{{ $message }}</p>
    @if(isset($action_route))
        <div class="mt-6">
            <a href="{{ $action_route }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ $action_label }}
            </a>
        </div>
    @endif
</div>