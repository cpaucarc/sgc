<select
    {{ $attributes->merge([
    'class' => 'text-sm transition duration-500 ease-in-out px-2 mt-1 rounded border border-gray-300 text-gray-600 focus:outline-none focus:text-gray-800 placeholder-gray-300'])
    }}>
    {{ $slot }}
</select>
