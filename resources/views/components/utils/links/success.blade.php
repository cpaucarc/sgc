<a {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-green-600 hover:text-white hover:bg-green-700 active:bg-green-600 font-bold whitespace-nowrap transition ease-in-out duration-300 border hover:border-green-600 rounded-md'
    ])
}}>
    {{$slot}}
</a>
