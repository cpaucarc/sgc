<div class="border border-white px-4 py-2 rounded-md bg-white font-mono bg-opacity-50 backdrop-blur-sm text-gray-800">
    {{-- Hora --}}
    <div>
        <div class="flex justify-center items-end gap-x-0 text-3xl font-bold font-mono">
            <span id="hour"></span>:
            <span id="minute"></span>
            <span id="second" class="text-lg ml-1 font-light"></span>
        </div>
    </div>
    {{-- Fecha --}}
    <div class="mt-1">
        <div class="flex justify-center gap-x-0 text-sm">
            <span id="weekday" class="sr-only"></span>
            <span id="day" class="ml-1"></span>
            <span id="month" class="ml-2"></span>,
            <span id="year" class="ml-1"></span>
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
            // var week = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
            var week = ['DO', 'LU', 'MA', 'MI', 'JU', 'VI', 'SA'];
            dweekday.textContent = week[weekday];

            // Obtenemos el dia del mes
            dday.textContent = day;

            // Obtenemos el Mes y año y lo mostramos
            var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ]
            dmonth.textContent = months[month];
            dyear.textContent = year;

            // Cambiamos las hora de 24 a 12 horas y establecemos si es AM o PM
            if (hour >= 12) {
                hour = hour - 12;
            }

            // Detectamos cuando sean las 0 AM y transformamos a 12 AM
            if (hour === 0) {
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
