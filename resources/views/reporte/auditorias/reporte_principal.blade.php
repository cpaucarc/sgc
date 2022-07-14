<!doctype html>
<html lang="es">

<head>
    <title>Auditorias</title>
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
                <img style="height: 75px" src="{{ public_path() . '/images/escudo_peru.jpg' }}" alt="Escudo Perú">
            </td>
            <td style="text-align: center;">
                <h6 class="font-weight-bold" style="margin: 0">Universidad Nacional Santiago Antúnez de Mayolo</h6>
                <p style="margin: 0">Vicerrectorado Académico</p>
                <p style="margin: 0">Oficina General de Calidad Universitaria</p>
            </td>
            <td style="width: 15%; text-align: right">
                <img style="height: 75px" src="{{ public_path() . '/images/escudo_unasam.jpg' }}" alt="Escudo Unasam">
            </td>
        </tr>
    </table>
</header>

<main>
    <table class="mb-0" style="width: 100%">
        <tbody>
        <tr>
            <td style="width: 80%; text-align: left;">
                <h4 class="font-weight-bold">Auditorias</h4>
            </td>
            <td style="width: 20%; text-align: right; margin: auto">
                <p style="font-size: 12px; margin-top: 2px">{{ now() }}</p>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="font-weight-bold my-0" style="font-size: 13px;">Facultad: <span
            style="text-transform: uppercase">{{ $facultad }}</span></p>
    <p class="font-weight-bold mb-4" style="font-size: 13px">Tipo de auditoria: <span
            style="text-transform: uppercase">{{ $tipo }}</span></p>

    @foreach($facultades as $facultad)
        <p class="font-weight-bold mt-5 mb-3" style="font-size: 16px;">
            <span style="text-transform: uppercase">{{ strtoupper($facultad->nombre) }}</span>
            <span class="font-weight-normal"
                  style="font-size: 0.75rem">{{ '('.count($facultad->auditorias) .' auditorias)' }}</span>
        </p>
        @if(count($facultad->auditorias))
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th style="padding: 3px 6px; width: 13px;">N°</th>
                    <th style="padding: 3px 6px; width: 125px;">Tipo de Auditoria</th>
                    <th style="padding: 3px 6px">Responsable</th>
                    <th style="padding: 3px 6px; width: 150px;">Documentos Adjuntos</th>
                    <th style="padding: 3px 6px; width: 135px;">Realización</th>
                </tr>
                </thead>
                <tbody>
                @foreach($facultad->auditorias as $i => $aud)
                    <tr>
                        <td style="padding: 3px 6px;">{{ $i + 1 }}</td>
                        <td style="padding: 3px 6px;">{{ $aud->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa' }}</td>
                        <td style="padding: 3px 6px;">{{ $aud->responsable }}</td>
                        <td style="padding: 3px 6px;">{{ $aud->documentos_count . ' documentos' }}</td>
                        <td style="padding: 3px 6px;">{{ $aud->created_at->format('d-m-Y h:i:s a') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p style="font-size: 0.8rem">No hay ninguna auditoria realizada en la Facultad de {{$facultad->nombre}}</p>
        @endif
    @endforeach
</main>

</body>
</html>
