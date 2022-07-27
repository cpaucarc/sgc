@props(['placement'=>'top'])
@php
    $class_svg = "h-5 w-5 text-gray-500 hover:text-gray-700 transition";
    $class_tooltip="inline-block absolute invisible z-10 opacity-0 tooltip grid place-items-center border border-zinc-200 bg-white rounded-sm transition"
@endphp

<button data-tooltip-target="tooltip-{{$placement}}" data-tooltip-placement="{{$placement}}">
    <svg class="{{$class_svg}}" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
              clip-rule="evenodd"/>
    </svg>
</button>
<div {{$attributes->merge(['id'=>'tooltip-'.$placement,'role'=>$placement,'class'=>$class_tooltip])}}>

    <div class="flex flex-col gap-y-2 items-center justify-center">

        @if(isset($image))
            <img class="object-cover w-60 h-36" src="{{ $image }}" alt="Imagen tooltip">
        @endif

        @if(isset($title) or isset($description))
            <div class="w-60 px-2 pb-2 text-center">
                @if(isset($title))
                    <h2 class="text-zinc-600 text-sm font-bold leading-snug">
                        {{ $title }}
                    </h2>
                @endif
                @if(isset($description))
                    <h3 class="text-zinc-500 text-xs mt-1 leading-snug">
                        {{ $description }}
                    </h3>
                @endif
            </div>
        @endif
    </div>
</div>

@push('js')
    <!-- Required popper.js -->
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
@endpush
