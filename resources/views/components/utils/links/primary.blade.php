<a {{ $attributes->merge([
    'class' => 'px-3 py-1 text-sm inline-flex items-center text-white bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-600 font-bold whitespace-nowrap transition border border-indigo-600 rounded-lg'
    ])
}}>
    {{$slot}}
</a>
