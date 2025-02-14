@props(['disabled' => false, 'label' => '', 'error' => ''])

<div>
    @if($label)
        <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">
            {{ $label }}
        </label>
    @endif
    
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' . ($error ? ' ring-red-300' : '')]) !!}>
    
    @if($error)
        <p class="mt-2 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>