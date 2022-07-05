<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-3 py-1.5 text-sm inline-flex items-center text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-500 font-bold whitespace-nowrap soft-transition rounded-md disabled:cursor-wait disabled:bg-blue-900 disabled:bg-opacity-75'
    ])
}}>
    {{$slot}}
</button>

