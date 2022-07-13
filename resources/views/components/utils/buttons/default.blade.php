<button {{ $attributes->merge([ 'class' => 'btn text-zinc-600 hover:text-zinc-700 hover:bg-zinc-50 active:bg-zinc-100 border border-zinc-300' ]) }}>
    {{$slot}}
</button>
