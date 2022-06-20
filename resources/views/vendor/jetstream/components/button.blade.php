<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-3 py-1 text-sm inline-flex items-center text-white bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-600 font-bold whitespace-nowrap soft-transition border border-indigo-600 rounded-md disabled:cursor-wait disabled:bg-indigo-900 disabled:bg-opacity-75'
    ])
}}>
    {{$slot}}
</button>

