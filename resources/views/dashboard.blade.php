<x-app-layout>
    {{-- Bienvenida y fecha actual --}}
    <div class="grid grid-cols-4 gap-6">
        <div class="col-span-3">
            <h3 class="text-gray-800 text-base">
                Bienvenido al Sistema de Gestión de Calidad de Ciencias Medicas
            </h3>
            <div class="rounded-lg p-4 border border-gray-300">
                <p class="text-gray-600 text-sm">
                    {{ Auth::user()->name }}
                </p>
            </div>
        </div>
        <div class="col-span-1">
            <div class="w-full grid grid-cols-5 gap-2">
                <div class="col-span-3 border rounded border-gray-300">
                    <div class="grid grid-cols-3 p-2 text-center">
                        <p class="col-span-3 text-sm text-gray-500">Son las</p>
                        <p id="hour" class="rounded border border-blue-600 text-gray-800 text-sm m-1 py-1.5"></p>
                        <p id="minute" class="rounded border border-blue-600 text-gray-800 text-sm m-1 py-1.5"></p>
                        <p id="second" class="rounded border border-blue-600 text-gray-800 text-sm m-1 py-1.5"></p>
                        <p class="text-sm text-gray-500">h</p>
                        <p class="text-sm text-gray-500">m</p>
                        <p class="text-sm text-gray-500">s</p>
                    </div>
                </div>
                <div class="col-span-2 border rounded border-gray-300 ">
                    <div class="p-2 text-center">
                        <p id="weekday" class="text-sm text-gray-500"></p>
                        <p id="day" class="text-4xl text-blue-600"></p>
                        <p id="month" class="text-sm text-gray-500"></p>
                    </div>
                </div>
                <div class="col-span-5 border rounded border-gray-300 text-center">
                    <p id="year" class="text-sm p-2"></p>
                </div>
            </div>
        </div>
    </div>


    <script>
        (function () {
            var updatetime = function () {
                // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
                var date = new Date(),
                    hour = date.getHours(),
                    minute = date.getMinutes(),
                    second = date.getSeconds(),
                    weekday = date.getDay(),
                    day = date.getDate(),
                    month = date.getMonth(),
                    year = date.getFullYear();

                // Accedemos a los elementos del DOM para agregar mas adelante sus correspondientes valores
                var dhour = document.getElementById('hour'),
                    dminute = document.getElementById('minute'),
                    dsecond = document.getElementById('second'),
                    dweekday = document.getElementById('weekday'),
                    dday = document.getElementById('day'),
                    dmonth = document.getElementById('month'),
                    dyear = document.getElementById('year');


                // Obtenemos el dia se la semana y lo mostramos
                var week = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                dweekday.textContent = week[weekday];

                // Obtenemos el dia del mes
                dday.textContent = day;

                // Obtenemos el Mes y año y lo mostramos
                var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre',
                    'Octubre', 'Noviembre', 'Diciembre'
                ]
                dmonth.textContent = months[month];
                dyear.textContent = year;

                // Cambiamos las hora de 24 a 12 horas y establecemos si es AM o PM
                if (hour >= 12) {
                    hour = hour - 12;
                }

                // Detectamos cuando sean las 0 AM y transformamos a 12 AM
                if (hour == 0) {
                    hour = 12;
                }

                // Si queremos mostrar un cero antes de las horas ejecutamos este condicional
                // if (horas < 10){horas = '0' + horas;}
                dhour.textContent = hour;

                // Minutos y Segundos
                if (minute < 10) {
                    minute = "0" + minute;
                }
                if (second < 10) {
                    second = "0" + second;
                }

                dminute.textContent = minute;
                dsecond.textContent = second;
            };
            updatetime();
            var interval = setInterval(updatetime, 1000);
        }())
    </script>
</x-app-layout>
