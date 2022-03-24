<div class="min-h-screen pt-10 bg-white">
    <div class="flex flex-col sm:justify-center items-center">
        <div>
            {{ $logo }}
        </div>

        <div
            class="w-10/12 sm:w-8/12 md:w-6/12 lg:w-3/12 border border-gray-300 mt-6 px-6 pt-2 pb-4 bg-gray-50 overflow-hidden rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
