<div>
    <x-utils.forms.select wire:model="cargo_participante"
                          onchange="cambiarCargo('{{ $participante->dni_participante }}')">
        <option value="0">Participante</option>
        <option value="1">Responsable</option>
    </x-utils.forms.select>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function cambiarCargo(dni) {
                Swal.fire({
                    text: "¿Desea cambiar de cargo a participante con DNI " + dni + " de la responsabilidad social?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, cambiar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('cambiarCargo');
                    }
                })
            }
        </script>
    @endpush
</div>
