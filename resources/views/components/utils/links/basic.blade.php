<a {{ $attributes->merge([ 'class' => 'inline-flex items-center font-bold text-zinc-700 hover:text-sky-700 hover:underline bg-transparent active:text-sky-600 font-semibold soft-transition' ]) }}>
    {{$slot}}
</a>
