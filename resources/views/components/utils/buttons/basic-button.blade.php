<button {{ $attributes->merge([
    'class' => 'px-3 py-2 text-sm font-semibold whitespace-nowrap transition rounded-lg'
    ])}}>
    {{$slot}}
</button>
