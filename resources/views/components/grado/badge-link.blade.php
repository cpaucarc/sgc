@props(['exists','bcolor'=>'yellow'])

@php
    $classes = "relative mx-2 my-2 bg-indigo-100 transition hover:bg-indigo-200 rounded text-indigo-700 px-6 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-indigo-700 cursor-pointer";
    $badge_clases="bg-yellow-500 bg-blue-500 bg-indigo-500 bg-green-500";
@endphp
<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($exists)
        <div class="absolute text-white -top-3 -right-3 px-2.5 py-0.5 bg-{{$bcolor}}-500 rounded-full text-xs">
            {{ $exists }}
        </div>
    @endif
    {{ $slot }}
</a>
