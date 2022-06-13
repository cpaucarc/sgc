<button {{ $attributes->merge([
    'class' => 'px-2 py-1 inline-flex items-center text-gray-500 bg-transparent hover:text-blue-600 active:text-blue-700 font-bold whitespace-nowrap soft-transition'
    ])
}}>
    {{$slot}}
</button>
