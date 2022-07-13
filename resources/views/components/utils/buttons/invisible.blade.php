<button {{ $attributes->merge([ 'class' => 'btn text-zinc-600 bg-transparent hover:text-sky-600 active:text-sky-700' ]) }}>
    {{$slot}}
</button>
