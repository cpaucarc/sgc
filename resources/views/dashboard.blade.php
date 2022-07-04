<x-app-layout>

    <div class="divide-dashed divide-gray-300 space-y-6">
        {{-- Bienvenida y Foto --}}
        <div class="grid grid-cols-5 gap-6">
            <div class="col-span-2 text-gray-800 font-semibold space-y-3">
                <h3 class="text-5xl font-bold">
                    Bienvenido
                </h3>
                <p class="inline-flex rounded bg-gradient-to-r from-indigo-700 to-indigo-500 text-white py-2 px-3 text-3xl">
                    {{ Auth::user()->name }}
                </p>
                <h3 class="text-2xl">
                    al Sistema de Gestión de Calidad
                </h3>
            </div>
            <div class="col-span-3 relative">
                <div class="absolute shadow right-2 top-2">
                    <x-utils.clock/>
                </div>
                <img class="w-full aspect-[4/3] rounded-lg object-cover" src="{{ asset('images/unasam/campus1.webp') }}"
                     alt="Campus">
            </div>
        </div>

        <hr>
        {{-- Enlaces --}}
        <div class="bg-gray-100 rounded-lg p-4">
            <div>
                <h3 class="font-bold text-gray-800 mb-4 text-2xl">Enlaces de Interés</h3>
                <div class="flex flex-wrap gap-4">
                    <x-utils.links.external
                        to="https://www.transparencia.gob.pe/enlaces/pte_transparencia_enlaces.aspx?id_entidad=10403&id_tema=5&ver=#.YldazujMLMV"
                        img="{{ asset('images/unasam_escudo.svg') }}">
                        Unasam
                    </x-utils.links.external>
                    <x-utils.links.external
                        to="https://www.gob.pe/institucion/unasam/funcionarios"
                        img="{{ asset('images/unasam_escudo.svg') }}">
                        Directorio Unasam
                    </x-utils.links.external>
                    <x-utils.links.external
                        to="https://www.facebook.com/OGCU.UNASAM/">
                        <svg
                            class="w-8 h-8 text-sky-600 group-hover:text-white transition ease-in-out duration-300 fill-current"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0"
                            x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" style="null">
                            <path
                                d="M40,0H10C4.486,0,0,4.486,0,10v30c0,5.514,4.486,10,10,10h30c5.514,0,10-4.486,10-10V10C50,4.486,45.514,0,40,0z M39,17h-3 c-2.145,0-3,0.504-3,2v3h6l-1,6h-5v20h-7V28h-3v-6h3v-3c0-4.677,1.581-8,7-8c2.902,0,6,1,6,1V17z"></path>
                        </svg>
                        OGCU
                    </x-utils.links.external>
                    <x-utils.links.external
                        to="http://www.unasam.edu.pe/facultad/y0zJyMzKT0tMLs0pSUzRNQcA"
                        img="{{ asset('images/unasam/icons/fcm.png') }}">
                        Portal FCM
                    </x-utils.links.external>
                    <x-utils.links.external to="http://sga.unasam.edu.pe/login"
                                            img="{{ asset('images/unasam_escudo.svg') }}">
                        SGA
                    </x-utils.links.external>
                    <x-utils.links.external to="http://campus.unasam.edu.pe/login/index.php"
                                            img="{{ asset('images/unasam/icons/sva.png') }}">
                        SVA
                    </x-utils.links.external>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
