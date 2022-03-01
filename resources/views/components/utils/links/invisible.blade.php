<a {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-blue-500 bg-transparent active:text-blue-600 font-bold whitespace-nowrap transition ease-in-out duration-300'
    ])
}}>
    {{$slot}}
</a>
