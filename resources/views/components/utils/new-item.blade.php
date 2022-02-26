@if(\Carbon\Carbon::parse($date)->diffInSeconds(\Carbon\Carbon::now()) <= 90)
    <x-utils.badge class="bg-green-100 text-green-700 font-semibold text-xs">
        Nuevo
    </x-utils.badge>
@endif
