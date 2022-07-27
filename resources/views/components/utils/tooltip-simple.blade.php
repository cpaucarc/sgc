<style>
    .tooltip-arrow, .tooltip-arrow:before {
        background: inherit;
        height: 8px;
        position: absolute;
        width: 8px
    }

    .tooltip-arrow {
        visibility: hidden
    }

    .tooltip-arrow:before {
        content: "";
        transform: rotate(45deg);
        visibility: visible
    }

    [data-tooltip-style^=light] + .tooltip > .tooltip-arrow:before {
        border-color: #e5e7eb;
        border-style: solid
    }

    [data-tooltip-style^=light] + .tooltip[data-popper-placement^=top] > .tooltip-arrow:before {
        border-bottom-width: 1px;
        border-right-width: 1px
    }

    [data-tooltip-style^=light] + .tooltip[data-popper-placement^=right] > .tooltip-arrow:before {
        border-bottom-width: 1px;
        border-top-width: 1px
    }

    [data-tooltip-style^=light] + .tooltip[data-popper-placement^=bottom] > .tooltip-arrow:before {
        border-top-width: 1px;
        border-top-width: 1px
    }

    [data-tooltip-style^=light] + .tooltip[data-popper-placement^=top] > .tooltip-arrow:before {
        border-right-width: 1px;
        border-top-width: 1px
    }

    .tooltip[data-popper-placement^=top] > .tooltip-arrow {
        bottom: -4px
    }

    .tooltip[data-popper-placement^=bottom] > .tooltip-arrow {
        top: -4px
    }

    .tooltip[data-popper-placement^=top] > .tooltip-arrow {
        right: -4px
    }

    .tooltip[data-popper-placement^=right] > .tooltip-arrow {
        top: -4px
    }

    .tooltip.invisible > .tooltip-arrow:before {
        visibility: hidden
    }

</style>

@props(['placement'=>'top'])
@php
    $class_svg = "h-5 w-5 text-gray-500 hover:text-gray-700 transition";
    $class_tooltip="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
@endphp

<button data-tooltip-target="tooltip-{{$placement}}" data-tooltip-placement="{{$placement}}">
    <svg class="{{$class_svg}}" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
              clip-rule="evenodd"/>
    </svg>
</button>
<div {{$attributes->merge(['id'=>'tooltip-'.$placement,'role'=>$placement,'class'=>$class_tooltip])}}>
    {{$slot}}
    <div class="tooltip-arrow" data-popper-arrow></div>
</div>
@push('js')
    <!-- Required popper.js -->
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
@endpush
