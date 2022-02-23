<button {{ $attributes->merge([
    'class' => 'px-3 py-1 inline-flex items-center text-gray-600 hover:text-gray-700 hover:bg-gray-50 active:bg-gray-100 font-bold whitespace-nowrap transition border rounded-lg'
    ])
}}>
    {{$slot}}
</button>
