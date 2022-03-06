<div>
    <label class="block text-sm font-medium text-gray-700">
        <div class="relative rounded-md">
            @if(isset($title))
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    {{$title}}
                </div>
            @endif
            <input {{ $attributes->merge([
                    'type' => 'text',
                    'class' => 'focus:ring-indigo-500 pl-14 bg-gray-50 py-1.5 focus:bg-white focus:border-indigo-500 block text-sm border-gray-300 rounded-md'
                    ])}}>
        </div>
    </label>
</div>
