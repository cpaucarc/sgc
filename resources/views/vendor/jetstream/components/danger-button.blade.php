<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'px-3 py-1 text-sm inline-flex items-center text-white bg-red-600 hover:bg-red-700 active:bg-red-600 font-bold whitespace-nowrap transition easy-in-out duration-300 border border-red-600 rounded-md']) }}>
    {{ $slot }}
</button>
