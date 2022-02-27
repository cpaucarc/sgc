@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="pt-2 divide-y divide-gray-300 space-y-4">
        @if(isset($title))
            <div class="px-4 text-lg flex items-center justify-between">
                {{ $title }}
            </div>
        @endif

        <div class="px-4 py-4">
            {{ $content }}
        </div>
    </div>

    @if(isset($footer))
        <div class="flex flex-row justify-end px-4 py-3 gap-2 bg-gray-50 text-right">
            {{ $footer }}
        </div>
    @endif
</x-jet-modal>
