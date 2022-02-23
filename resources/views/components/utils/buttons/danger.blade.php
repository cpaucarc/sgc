<button {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-red-600 hover:text-white hover:bg-red-700 active:bg-red-600 font-bold whitespace-nowrap transition ease-in-out duration-300 border hover:border-red-600 rounded-md'
    ])
}}>
    {{$slot}}
</button>
