@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
     'rows'=>"3",
    'class' => 'px-2 py-1.5 text-sm text-zinc-900 bg-zinc-50 focus:bg-white soft-transition border-zinc-300 focus:border-sky-500 focus:ring-sky-500 rounded-md placeholder:text-zinc-400'
    ]) !!}
>
    {{ $slot }}
</textarea>
