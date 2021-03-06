<div>

    @if($open)
        <div class="px-8 py-3">
            <canvas id="bar-chart"></canvas>

            <h3 class="mt-4 flex items-center justify-center font-semibold text-gray-400 text-sm print:hidden">
                <x-icons.info class="h-5 w-5 mr-1 flex-shrink-0" stroke="1.55"/>
                Si no puede ver el gráfico, pruebe a refrescar la página. <kbd>F5</kbd>
            </h3>
        </div>
    @endif

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

        <script>
            Livewire.on('eventRenderGraph', datos => {

                let sobresaliente, minimo, bar;
                let labels, colores;

                sobresaliente = datos.sobresaliente;
                minimo = datos.minimo;
                bar = datos.bar;
                labels = datos.labels;
                colores = datos.colors;
                lineas = datos.lines;

                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                type: 'line',
                                label: 'Sobresaliente',
                                data: sobresaliente,
                                fill: false,
                                borderColor: lineas['sobresaliente'],
                                tension: 0.1,
                                pointBorderWidth: 7,
                            }, {
                                type: 'line',
                                label: 'Minimo',
                                data: minimo,
                                fill: false,
                                borderColor: lineas['minimo'],
                                tension: 0.1,
                                pointBorderWidth: 7,
                            }, {
                                type: 'bar',
                                label: 'Resultado',
                                data: bar,
                                backgroundColor: colores
                            },
                        ],
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        title: {
                            display: false,
                            text: 'Comportamiento del indicador'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        responsive: true,
                    }
                });

            })
        </script>

    @endpush

</div>
