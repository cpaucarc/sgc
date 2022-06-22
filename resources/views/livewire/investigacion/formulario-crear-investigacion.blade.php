<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar nueva Investigación
        </h2>
    </div>

    <div class="space-y-6 divide-y divide-dashed divide-stone-200 pt-4">
        <div class="space-y-4">
            <div>
                <x-jet-label for="titulo" value="Título de la RSU"/>
                <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                             wire:model.defer="titulo" autocomplete="off" autofocus/>
                <x-jet-input-error for="titulo"/>
            </div>
            <div>
                <x-jet-label for="resumen" value="Breve Resumen de la Investigación"/>
                <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="resumen"
                                        id="resumen"/>
                <x-jet-input-error for="resumen"></x-jet-input-error>
            </div>
        </div>
        <div class="pt-6">
            <x-jet-label for="semestre" value="Semestre"/>
            <x-utils.forms.select id="semestre" class="mt-1 block w-full" wire:model.defer="semestre">
                @foreach($semestres as $sem)
                    <option value="{{ $sem->id }}">{{ $sem->nombre }}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="semestre"/>
        </div>
        @if(count($this->escuelas) > 1)
            <div class="pt-6">
                <x-jet-label for="escuela" value="Programa Académico"/>
                <x-utils.forms.select id="escuela" class="mt-1 block w-full" wire:model.defer="escuela">
                    <option value="0">Selecciona el programa académico</option>
                    @foreach($escuelas as $esc)
                        <option value="{{ $esc->id }}">{{ $esc->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="escuela"/>
            </div>
        @endif
        <div class="space-y-4 pt-6">
            <div>
                <x-jet-label for="area" value="Área de Investigación"/>
                <x-utils.forms.select id="area" class="mt-1 block w-full" wire:model="area">
                    <option value="0">Selecciona el área de investigación</option>
                    @foreach($areas as $ar)
                        <option value="{{ $ar->id }}">{{$ar->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="area"/>
            </div>
            @if($lineas)
                <div>
                    <x-jet-label for="linea" value="Línea de Investigación"/>
                    <x-utils.forms.select id="linea" class="mt-1 block w-full" wire:model="linea">
                        <option value="0">Selecciona la línea de investigación</option>
                        @foreach($lineas as $ln)
                            <option value="{{ $ln->id }}">{{$ln->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="linea"/>
                </div>
            @endif
            @if($sublineas)
                <div>
                    <x-jet-label for="sublinea" value="Sublínea de Investigación"/>
                    <x-utils.forms.select id="sublinea" class="mt-1 block w-full" wire:model="sublinea">
                        <option value="0">Selecciona la sublínea de investigación</option>
                        @foreach($sublineas as $sln)
                            <option value="{{ $sln->id }}">{{$sln->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="sublinea"/>
                </div>
            @endif
        </div>
    </div>

    <div class="flex justify-end pt-4 mb-6">
        <x-jet-button wire:click="guardar" wire:target="guardar"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardar" class="icon-5"/>
            {{ __('Registrar Investigación') }}
        </x-jet-button>
    </div>


    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('guardado', msg => {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: msg,
                });
            });
            Livewire.on('error', msg => {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: msg,
                });
            });
        </script>
    @endpush

</div>
