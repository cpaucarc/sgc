<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn text-sm text-white bg-sky-600 hover:bg-sky-700 active:bg-sky-600 border border-sky-700 disabled:cursor-not-allowed disabled:bg-sky-900 disabled:bg-opacity-75'
    ])
}}>
    {{$slot}}
</button>
