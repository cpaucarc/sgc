<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-3 py-1 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 tracking-wider hover:text-gray-600 focus:bg-gray-100 active:text-gray-800 active:bg-gray-100 disabled:opacity-25 transition active:scale-90']) }}>
    {{ $slot }}
</button>
