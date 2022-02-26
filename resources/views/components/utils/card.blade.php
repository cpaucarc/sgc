<div
    {{ $attributes->merge(['class' => "bg-white border border-gray-300 divide-y divide-gray-300 rounded-md text-gray-700"]) }}>

    @if(isset($header))
        <div class="px-4 py-3 rounded-t-md">
            {{ $header }}
        </div>
    @endif

    <div class="px-4 py-3">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-3 bg-stone-50 rounded-b-md">
            {{ $footer }}
        </div>
    @endif

</div>
