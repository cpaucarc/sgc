<a {{ $attributes->merge([
    'class' => 'inline-flex items-center font-bold text-gray-600 hover:text-sky-600 hover:underline bg-transparent active:text-sky-500 font-semibold whitespace-nowrap transition ease-in-out duration-300'
    ])
}}>
    {{$slot}}
</a>
