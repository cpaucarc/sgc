<div>
    <label class="block text-sm font-medium text-zinc-700">
        <div class="relative rounded-md">
            @if(isset($title))
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    {{$title}}
                </div>
            @endif
            <input {{ $attributes->merge([
                    'type' => 'text',
                    'class' => 'focus:ring-sky-500 pl-14 bg-zinc-50 py-1.5 focus:bg-white focus:border-sky-500 block text-sm border-zinc-300 rounded-md'
                    ])}}>
        </div>
    </label>
</div>
