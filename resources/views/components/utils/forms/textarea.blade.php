@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
     'rows'=>"3",
    'class' => 'px-2 py-1.5 text-sm bg-gray-50 focus:bg-white transition border-gray-300 focus:border-indigo-500 rounded-md placeholder:text-gray-400'
    ]) !!}
>
    {{ $slot }}
</textarea>
