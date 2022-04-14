<a href="{{ $to }}"
   target="_blank"
   class="flex items-center gap-x-2 px-2 py-1 rounded bg-gray-50 text-gray-600 hover:text-sky-600 font-semibold hover:bg-gray-100 hover:underline transition ease-in-out duration-300"
   rel="noreferrer nofollow">
    <img src="{{ $img }}" class="w-8 h-8 flex-shrink-0 object-cover" alt="Icono">
    {{ $slot }}
</a>
