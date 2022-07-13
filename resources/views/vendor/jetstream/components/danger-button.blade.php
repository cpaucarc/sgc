<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'btn text-sm text-white bg-rose-600 hover:bg-rose-700 active:bg-rose-600 border border-rose-700']) }}>
    {{ $slot }}
</button>
