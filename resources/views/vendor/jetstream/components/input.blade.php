@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'px-2 py-1 bg-gray-50 focus:bg-white text-sm transition border-gray-300 focus:border-indigo-500 rounded-md placeholder:text-gray-400'
    ]) !!}>
