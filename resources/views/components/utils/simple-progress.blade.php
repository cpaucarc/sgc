<div class="relative my-auto pt-2">
    <div class="flex mb-2 items-center justify-between">
        <div class="text-sm font-semibold inline-block py-1 px-3 rounded-full text-gray-600 bg-gray-100">
            {{ $slot }}
        </div>
        <div class="text-right text-sm font-semibold inline-block text-{{$color}}-{{$opacity}}">
            {{ $percent }}%
        </div>
    </div>
    <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-gray-100">
        <div style="width:{{ $percent }}%"
             class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-{{$color}}-{{$opacity}}"></div>
    </div>
</div>
