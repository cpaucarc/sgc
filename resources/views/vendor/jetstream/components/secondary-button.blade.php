<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'btn bg-white border border-zinc-300 text-sm text-zinc-700 tracking-wider hover:text-zinc-600 focus:bg-zinc-100 active:text-zinc-800 active:bg-zinc-100 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
