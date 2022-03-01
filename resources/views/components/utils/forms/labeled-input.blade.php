<div>
    <label for="price" class="block text-sm font-medium text-gray-700">
        <div class="mt-1 relative rounded-md">
            <div class="absolute inset-y-0 left-0 pl-3 mr-2 flex items-center pointer-events-none">
                @if(isset($title))
                    {{$title}}
                @endif
            </div>
            <input type="text" {{ $attributes }}
            class="focus:ring-indigo-500 bg-gray-50 py-1.5 focus:bg-white focus:border-indigo-500 block w-full pl-10 pr-2 text-sm border-gray-300 rounded-md">
        </div>
    </label>
</div>
