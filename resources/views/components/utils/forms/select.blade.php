<select
    {{ $attributes->merge([
    'class' => 'text-sm bg-zinc-50 soft-transition pl-2 pr-8 py-1.5 rounded-md border border-zinc-300 text-zinc-900 focus:text-zinc-800 focus:bg-white focus:border-sky-500 focus:ring-sky-500 placeholder-zinc-400'])
    }}>
    {{ $slot }}
</select>
