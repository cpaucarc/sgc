<button {{ $attributes->merge([ 'class' => 'btn text-sky-600 hover:text-white hover:bg-sky-700 active:bg-sky-600 border hover:border-sky-600' ]) }}>
    {{$slot}}
</button>
