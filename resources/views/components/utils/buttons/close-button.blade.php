<button {{ $attributes->merge([
    'class' => 'h-8 w-8 grid place-content-center flex-shrink-0 text-sm font-semibold whitespace-nowrap transition rounded-full text-gray-400 hover:text-rose-600 bg-transparent hover:bg-rose-200'
    ])}}>
    <x-icons.x :stroke="1.5" class="h-5 w-5"/>
</button>
