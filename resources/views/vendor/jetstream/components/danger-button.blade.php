<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center justify-center px-3 py-1 bg-red-600 border border-red-700 rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-800 active:bg-red-800 disabled:opacity-25 transition active:scale-90']) }}>
    {{ $slot }}
</button>
