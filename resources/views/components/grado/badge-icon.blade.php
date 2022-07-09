@props(['quantity'])
@php
    $classes = "absolute -top-1 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full";
@endphp

@if($quantity)
    <div class="relative inline-block">
        {{$slot}}
        <span class="{{$classes}}">{{$quantity}}</span>
    </div>
@endif
