<a {{ $attributes->merge([
    'class' => 'inline-flex items-center font-semibold text-gray-700 hover:text-blue-700 hover:underline bg-transparent active:text-blue-600 font-semibold transition ease-in-out duration-300'
    ])
}}>
    {{$slot}}
</a>
