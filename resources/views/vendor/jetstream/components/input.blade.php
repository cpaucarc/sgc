@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'input bg-gray-50 focus:bg-white border-gray-300 focus:border-sky-500 focus:ring-sky-500 placeholder:text-gray-400 out-of-range:border-rose-600 soft-transition'
    ]) !!}>
