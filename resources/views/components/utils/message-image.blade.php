<div class="grid place-items-center p-4 border border-stone-200 rounded-md">

    <div class="flex flex-col gap-y-2 items-center justify-center">

        @if(isset($image))
            <img class="w-1/2" src="{{ $image }}" alt="Imagen correspondiente">
        @endif

        @if(isset($title) or isset($description))
            <div class="w-1/2 text-center">
                @if(isset($title))
                    <h2 class="font-bold text-gray-600 leading-snug">
                        {{ $title }}
                    </h2>
                @endif
                @if(isset($description))
                    <h3 class="text-gray-500 text-sm mt-1 leading-snug">
                        {{ $description }}
                    </h3>
                @endif
            </div>
        @endif


    </div>

</div>
