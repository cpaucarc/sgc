<div class="space-y-6">
    @if($requisitos->count())
        @foreach( $requisitos as $requisito )
            <div class="flex items-center text-sm">
                <span class="bg-red-200 text-red-600 mr-2 rounded-full p-1">
                    <x-icons.x :stroke="1.5" class="h-4 w-4"/>
                </span>
                {{ $requisito->nombre }}
            </div>
        @endforeach
    @else
        <div class="flex items-center text-sm">
            <span class="bg-lime-200 text-lime-600 mr-2 rounded-full p-1">
                <x-icons.check :stroke="1.5" class="h-4 w-4"/>
            </span>
            <span>
                Ya presentó todos los requisitos.
            </span>
        </div>
    @endif

    <x-utils.badge class="bg-yellow-200 text-yellow-800 mt-4">
        La autoridad correspondiente responderá a medida que usted vaya enviando los requisitos.
    </x-utils.badge>
</div>
