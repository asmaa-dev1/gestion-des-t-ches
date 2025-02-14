@props(['type' => 'info', 'message'])

@php
$classes = match ($type) {
    'success' => 'bg-green-50 text-green-800',
    'error' => 'bg-red-50 text-red-800',
    'warning' => 'bg-yellow-50 text-yellow-800',
    default => 'bg-blue-50 text-blue-800'
};

$iconClasses = match ($type) {
    'success' => 'text-green-400 fas fa-check-circle',
    'error' => 'text-red-400 fas fa-exclamation-circle',
    'warning' => 'text-yellow-400 fas fa-exclamation-triangle',
    default => 'text-blue-400 fas fa-info-circle'
};
@endphp

<div class="rounded-md p-4 {{ $classes }}">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="{{ $iconClasses }}"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium">
                {{ $message }}
            </p>
        </div>
    </div>
</div>