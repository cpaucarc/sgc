<x-app-layout>

    <x-utils.titulo
        titulo="{{ 'Auditoria interna' }}">
        @slot('subtitulo')
            <div class="text-sm text-zinc-600">
                <p class="block">Facultad <b>{{$facultad->nombre}}</b></p>
                <p>Semestre <b>{{$semestre->nombre}}</b></p>
            </div>
        @endslot
    </x-utils.titulo>

    <livewire:auditoria.realizar-auditoria-interna facultad_id="{{ $facultad->id }}" semestre_id="{{ $semestre->id }}"/>
</x-app-layout>
