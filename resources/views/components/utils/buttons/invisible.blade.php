<button {{ $attributes->merge([
    'class' => 'px-2 py-1 inline-flex items-center text-blue-500 bg-transparent hover:text-blue-600 active:text-blue-700 font-bold whitespace-nowrap transition ease-in-out duration-300'
    ])
}}>
    {{$slot}}
</button>
