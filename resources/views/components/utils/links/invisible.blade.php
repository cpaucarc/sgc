<a {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-sky-700 bg-transparent active:text-sky-500 font-bold whitespace-nowrap transition ease-in-out duration-300'
    ])
}}>
    {{$slot}}
</a>
