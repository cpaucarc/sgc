<a {{ $attributes->merge([ 'class' => 'btn text-sm text-rose-600 hover:text-white hover:bg-rose-700 active:bg-rose-600 border hover:border-rose-600' ]) }}>
    {{$slot}}
</a>
