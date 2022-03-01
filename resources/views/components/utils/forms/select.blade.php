<select
    {{ $attributes->merge([
    'class' => 'text-sm bg-gray-50 focus:bg-white transition duration-500 ease-in-out px-2 py-1.5 mt-1 rounded-md border border-gray-300 text-gray-700 focus:outline-none focus:text-gray-800 placeholder-gray-400'])
    }}>
    {{ $slot }}
</select>
