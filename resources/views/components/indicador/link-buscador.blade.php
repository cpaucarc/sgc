<a {{ $attributes->merge([
    'class' => 'inline-flex gap-x-2 py-2 px-2 group hover:bg-gray-50 text-gray-600 hover:text-gray-800 items-center text-sm transition ease-in-out duration-300'
    ])}}>
    <div
        class="h-6 w-6 flex-shrink-0 grid place-items-center bg-indigo-100 group-hover:bg-indigo-200 text-indigo-800 rounded-full transition ease-in-out duration-300">
        {{ substr($codigo,-2) }}
    </div>
    <p class="flex-1 line-clamp-2 leading-4">
        {{ $objetivo }}
    </p>
</a>

{{--<a {{ $attributes->merge([--}}
{{--    'class' => 'px-3 py-1 inline-flex items-center text-red-600 hover:text-white hover:bg-red-700 active:bg-red-600 font-bold whitespace-nowrap transition ease-in-out duration-300 border hover:border-red-600 rounded-md'--}}
{{--    ])--}}
{{--}}>--}}
{{--    {{$slot}}--}}
{{--</a>--}}
