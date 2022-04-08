<button {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-indigo-600 hover:text-white hover:bg-indigo-700 active:bg-indigo-600 font-bold whitespace-nowrap transition ease-in-out duration-300 border hover:border-indigo-600 rounded-md'
    ])
}}>
    {{$slot}}
</button>
