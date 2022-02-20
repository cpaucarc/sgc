@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
     'rows'=>"3",
    'class' => 'px-2 py-1 text-sm transition border-gray-300 focus:border-indigo-500 rounded-md placeholder:text-gray-400'
    ]) !!}>
</textarea>
