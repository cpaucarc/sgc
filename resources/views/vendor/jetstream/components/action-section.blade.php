<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-jet-section-title>
        <x-slot name="title"><h2 class="font-bold text-gray-800">{{ $title }}</h2></x-slot>
        <x-slot name="description">
            <p class="w-10/12 text-sm text-gray-600">
                {{ $description }}
            </p>
        </x-slot>
    </x-jet-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white border shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
