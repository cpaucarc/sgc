<a href="{{ $to }}"
   target="_blank"
   class="group flex items-center gap-x-2 px-8 py-4 text-lg rounded font-semibold bg-white text-gray-700 hover:text-white hover:bg-indigo-600 transition ease-in-out duration-300"
   rel="noreferrer nofollow">
    @if(isset($img))
        <img src="{{ $img }}" class="h-8 overflow-hidden flex-shrink-0 object-cover" alt="Icono">
    @endif
    {{ $slot }}
</a>
