<button {{ $attributes->merge([
    'class' => 'px-2 py-1 text-sm font-semibold whitespace-nowrap transition rounded-lg active:scale-90'
    ])}}>
    {{$slot}}
</button>
