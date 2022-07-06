@props(['version'=>'2.0.0', 'company' => 'Universidad Nacional Santiago Antúnez de Mayolo'])
<footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="py-4 mt-4 border-t border-gray-100 sm:items-center sm:justify-between sm:flex">
        <p class="text-sm text-gray-500">
            &copy; {{$company}}
        </p>
        <strong class="inline-flex items-center p-2 space-x-2 text-sm font-medium border border-gray-200 rounded">
            <span class="text-gray-500"> Versión: </span>
            <span class="w-3 h-3 bg-green-600 rounded-full"></span>
            <span class="font-medium text-green-600">{{$version}}</span>
            <span
                class="inline-flex items-center py-1 px-2 text-xs font-medium border border-green-600 text-green-600 font-bold rounded-xl">Latest</span>
        </strong>
    </div>
</footer>
