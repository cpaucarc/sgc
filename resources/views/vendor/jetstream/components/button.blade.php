<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-3 py-1 bg-indigo-600 border border-indigo-700 rounded-md font-bold text-sm text-white tracking-wider hover:bg-indigo-700 focus:bg-indigo-800 active:bg-indigo-800 focus:outline-none disabled:opacity-25 transition active:scale-90'
    ]) }}>
    {{ $slot }}
</button>
