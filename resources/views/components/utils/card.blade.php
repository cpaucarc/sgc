<div
    {{ $attributes->merge(['class' => "bg-white border border-stone-300 divide-y divide-stone-200 rounded-lg text-stone-700"]) }}>

    @if(isset($header))
        <div class="px-4 py-3 rounded-t-lg">
            {{ $header }}
        </div>
    @endif

    <div class="px-4 py-3">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-4 py-3 bg-stone-50 rounded-b-lg">
            {{ $footer }}
        </div>
    @endif

</div>
