<!doctype html>
<html lang="es">

<head>
    <title>Auditoria Interna</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        * {
            font-family: ui-sans-serif, system-ui, Arial, Helvetica, sans-serif;
            font-size: 13px;
        }

        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 7cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        header {
            position: fixed;
            top: 2cm;
            left: 2cm;
            right: 2cm;
            height: 4cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        table {
            border-collapse: collapse;
        }

        .border {
            border: 1px solid #d4d4d8;
            padding: 5px 10px;
        }

        .text-center {
            text-align: center;
        }

        .m-0 {
            margin: 0;
        }
    </style>
</head>

<body>

<header>
    <table style="width: 100%;">
        <tr>
            <td style="width: 20%; border-bottom: 1px solid #d4d4d8; padding-bottom: 10px;" class="text-center">
                <img style="height: 70px" src="{{ public_path() . '/images/escudo_peru.jpg' }}" alt="Escudo Perú">
            </td>
            <td class="text-center" style="border-bottom: 1px solid #d4d4d8; padding-bottom: 10px;">
                <h6 class="font-weight-bold m-0">Universidad Nacional Santiago Antúnez de Mayolo</h6>
                <p class="m-0">Vicerrectorado Académico</p>
                <p class="m-0">Oficina General de Calidad Universitaria</p>
            </td>
            <td style="width: 20%; border-bottom: 1px solid #d4d4d8; padding-bottom: 10px;" class="text-center">
                <img style="height: 70px" src="{{ public_path() . '/images/escudo_unasam.jpg' }}" alt="Escudo Unasam">
            </td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>
        <tr>
            <td class="text-center">
                <p></p>
            </td>
            <td class="text-center">
                <h1 class="m-0" style="font-size: 16px;">INFORME DE AUDITORIA</h1>
                <h2 class="m-0" style="text-transform: uppercase;">FACULTAD DE {{ $facultad->nombre }}</h2>
                <h2 class="m-0">SEMESTRE {{ strtoupper($semestre->nombre) }}</h2>
            </td>
            <td class="text-center">
                <p>
                    {{ $auditoria->created_at->format('d, M Y') }}
                </p>
            </td>
        </tr>
    </table>
</header>

<main>

    <div>
        <table>
            <tbody>
            @foreach($detalles as $i => $detalle)
                <tr>
                    <td colspan="6">
                        <h2 style="font-size: 14px; text-transform: uppercase;">
                            {{ str_pad(($i + 1), 2, "0", STR_PAD_LEFT) }}
                            - {{ $detalle['entidad'] }}</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><br></td>
                </tr>
                <tr>
                    <td class="border" style="width: 25px;"><b>N°</b></td>
                    <td class="border"><b>Proceso</b></td>
                    <td class="border"><b>Actividad</b></td>
                    <td class="border"><b>Salida</b></td>
                    <td class="border"><b>Documentos</b></td>
                    <td class="border" style="width: 200px;"><b>Observación</b></td>
                </tr>
                @foreach($detalle['salidas'] as $j => $salida)
                    <tr>
                        <td class="border" style="width: 25px;">{{ ($i + 1) . '.'. ($j + 1) }}</td>
                        <td class="border">{{ $salida['proceso'] }}</td>
                        <td class="border">{{ $salida['actividad'] }}</td>
                        <td class="border">{{ $salida['salida'] }}</td>
                        <td class="border" style="white-space: nowrap;">{{ $salida['documentos'] }} documentos</td>
                        <td class="border" style="width: 200px;">{{ $salida['observacion'] }}</td>
                    </tr>
                @endforeach
                <tr style="page-break-after: always;">
                    <td colspan="6"><br></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div style="page-break-before: always;">
        <table>
            <tbody>
            <tr>
                <td class="border"><b>Nombre del responsable de la auditoria</b></td>
                <td class="border" style="text-transform: uppercase;">{{ $auditoria->auditor_nombre }}</td>
            </tr>
            <tr>
                <td class="border"><b>DNI del responsable de la auditoria</b></td>
                <td class="border" style="text-transform: uppercase;">{{ $auditoria->auditor_dni }}</td>
            </tr>
            <tr>
                <td class="border"><b>Observación general de la auditoria</b></td>
                <td class="border" style="text-transform: uppercase;">{{ $auditoria->observacion }}</td>
            </tr>
            <tr>
                <td class="border"><b>Fecha de la auditoria</b></td>
                <td class="border" style="text-transform: uppercase;">{{ $auditoria->created_at->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="border"><b>Firma del responsable de la auditoria</b></td>
                <td class="border"><br><br><br><br><br></td>
            </tr>
            </tbody>
        </table>
    </div>

</main>


</body>

</html>
