<x-app-layout>

    <div class="divide-y divide-dashed divide-gray-300 space-y-6">
        {{-- Bienvenida y Foto --}}
        <div class="grid grid-cols-5 gap-6">
            <div class="col-span-2 text-gray-800 font-semibold space-y-3">
                <h3 class="text-5xl font-bold">
                    Bienvenido
                </h3>
                <p class="inline-flex bg-gradient-to-r from-indigo-700 to-indigo-500 text-white py-2 px-3 text-3xl">
                    {{ Auth::user()->name }}
                </p>
                <h3 class="text-2xl">
                    al Sistema de Gestión de Calidad
                </h3>
            </div>
            <div class="col-span-3 relative">
                <div class="absolute shadow right-1 top-1">
                    <x-utils.clock/>
                </div>
                <img class="w-full aspect-[4/3] rounded-lg object-cover" src="{{ asset('images/unasam/campus1.webp') }}"
                     alt="Campus">
            </div>
        </div>

        {{-- Enlaces --}}
        <div class="pt-6">
            <div>
                <h3 class="font-bold text-gray-800 mb-4 text-xl">Enlaces externos de interes</h3>
                <div class="flex flex-wrap gap-2">
                    <x-utils.links.external to="http://sga.unasam.edu.pe/login"
                                            img="http://sga.unasam.edu.pe/images/icons/icon.png">
                        SGA
                    </x-utils.links.external>
                    <x-utils.links.external
                        to="https://www.transparencia.gob.pe/enlaces/pte_transparencia_enlaces.aspx?id_entidad=10403&id_tema=5&ver=#.YldazujMLMV"
                        img="https://www.drescalante.com.pe/images/universidad3.png">
                        Unasam
                    </x-utils.links.external>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
