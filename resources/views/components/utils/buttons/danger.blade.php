<button {{ $attributes->merge([ 'class' => 'btn bg-white text-rose-600 hover:bg-rose-700 hover:text-white active:bg-rose-600 border hover:border-rose-600' ]) }}>
    {{$slot}}
</button>
