<!doctype html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            margin: 100px 50px;
        }

        header {
            border-bottom: 1px solid #DEE2E6;
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            height: 85px;
        }

        footer {
            text-align: center;
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50px;
        }

        main {
            margin-top: 20px;
            margin-bottom: 0;
            height: auto;
            width: 100%;
        }

        table {
            font-size: 12px;
        }
    </style>
</head>

<body class="mt-5">

<header>
    <table style="width: 100%;">
        <tr>
            <td style="width: 15%;">
                <img style="height: 65px" src="{{ public_path() . '/images/escudo_peru.jpg' }}" alt="Escudo Perú">
            </td>
            <td style="text-align: center;">
                <h6 class="font-weight-bold" style="margin: 0">Universidad Nacional Santiago Antúnez de Mayolo</h6>
                <p style="margin: 0">Vicerrectorado Académico</p>
                <p style="margin: 0">Oficina General de Calidad Universitaria</p>
            </td>
            <td style="width: 15%; text-align: right">
                <img style="height: 65px" src="{{ public_path() . '/images/escudo_unasam.jpg' }}" alt="Escudo Unasam">
            </td>
        </tr>
    </table>
</header>

<main>

    <table class="mb-0" style="width: 100%">
        <tbody>
        <tr>
            <td style="width: 80%; text-align: left;">
                <h4 class="font-weight-bold">Indicadores</h4>
            </td>
            <td style="width: 20%; text-align: right; margin: auto">
                <p style="font-size: 12px; margin-top: 2px">{{ now() }}</p>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="font-weight-bold mb-4" style="font-size: 15px">
        Semestre: {{ $semestre }} {{ $semestre_count > 1 ?  '('.$semestre_count . ' semestres)' : ''}}
    </p>

    {{--    <div>--}}
    {{--        {{ $entidad }}--}}
    {{--    </div>--}}

    <p class="font-weight-bold my-2" style="font-size: 16px"> {{strtoupper($entidad->nombre) }}</p>
    <p class="mb-4" style="font-size: 0.8rem;">
        Se encontró un total de {{$entidad->indicadores_count}} indicadores asignados
    </p>
    @if($entidad->indicadores_count)
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th style="padding: 3px 6px">N°</th>
                <th style="padding: 3px 6px; width: 50px">Código</th>
                <th style="padding: 3px 6px">Objetivo</th>
                <th style="padding: 3px 6px; width: 150px">Proceso</th>
                <th style="padding: 3px 6px">Medición</th>
                <th style="padding: 3px 6px">Realizado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entidad->indicadores as $i => $indicador)
                <tr>
                    <td style="padding: 3px 6px">{{ $i + 1 }}</td>
                    <td style="padding: 3px 6px">{{ $indicador->cod_ind_inicial }}</td>
                    <td style="padding: 3px 6px">{{ $indicador->objetivo }}</td>
                    <td style="padding: 3px 6px">{{ $indicador->proceso->nombre }}</td>
                    <td style="padding: 3px 6px">{{ $indicador->medicion->nombre }}</td>
                    <td style="padding: 3px 6px">
                        {{ count($indicador->analisis) }}
                        de {{ (6/$indicador->medicion->tiempo_meses)*$semestre_count }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Aún no hay ningún registro que mostrar</p>
    @endif

</main>

</body>

</html>
