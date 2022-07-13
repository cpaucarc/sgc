<a {{ $attributes->merge([ 'class' => 'btn text-green-600 hover:text-white hover:bg-green-700 active:bg-green-600 border hover:border-green-600' ]) }}>
    {{$slot}}
</a>
