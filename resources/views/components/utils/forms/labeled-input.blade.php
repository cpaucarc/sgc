<label class="whitespace-nowrap border border-gray-300 text-gray-600 px-2 py-1 rounded-md bg-stone-50 text-sm">
    @if(isset($title))
        {{$title}}
    @endif
    <x-utils.forms.invisible-input {{ $attributes }}/>
</label>
