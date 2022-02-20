@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'px-2 py-1 text-sm transition border-gray-300 focus:border-indigo-500 rounded-md placeholder:text-gray-400'
    ]) !!}>
