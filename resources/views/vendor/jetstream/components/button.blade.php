<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn text-sm text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-500 disabled:cursor-not-allowed disabled:bg-sky-900 disabled:bg-opacity-75'
    ])
}}>
    {{$slot}}
</button>

