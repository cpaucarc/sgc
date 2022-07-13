@php
    $year = date("Y");
@endphp

<footer class="absolute bottom-0 min-w-full px-16 sm:px-6 lg:px-16">
    <div class="py-5 border-t border-zinc-300 sm:items-center sm:justify-between sm:flex">
        <p class="text-sm text-zinc-500">
            &copy; {{ $year }} Oficina General de Calidad Universitaria - UNASAM
        </p>

        <p class="text-sm text-zinc-500">
            SGC v{{ env('APP_VERSION'), '2.0' }}
        </p>
    </div>
</footer>
