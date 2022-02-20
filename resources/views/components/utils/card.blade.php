<div
    {{ $attributes->merge(['class' => "bg-white border border-gray-200 divide-y divide-gray-200 rounded-lg text-gray-700"]) }}>

    @if(isset($header))
        <div class="px-4 py-3 rounded-t-lg">
            {{ $header }}
        </div>
    @endif

    <div class="px-6 py-4">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="p-4 bg-gray-50 rounded-b-lg">
            {{ $footer }}
        </div>
    @endif

</div>
