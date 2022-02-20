<button {{ $attributes->merge(['class' => 'px-2 py-1 inline-flex items-center text-sm font-semibold whitespace-nowrap transition border rounded-lg active:scale-90'])}}>
    {{$slot}}
</button>
