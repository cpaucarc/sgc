<!doctype html>
<html lang="en">

<head>
    <title>Convenios</title>
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
                <h4 class="font-weight-bold">Convenios</h4>
            </td>
            <td style="width: 20%; text-align: right; margin: auto">
                <p style="font-size: 12px; margin-top: 2px">@php echo now() @endphp</p>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="font-weight-bold my-0" style="font-size: 13px">Facultad: <span style="text-transform: uppercase">{{ $facultad }}</span></p>
    <p class="font-weight-bold mb-4" style="font-size: 13px">Semestre: <span style="text-transform: uppercase">{{ $semestre }}</span></p>

    {{--  Datos AQUI  --}}
    @if(count($convenios))
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th style="padding: 3px 6px">N°</th>
            <th style="padding: 3px 6px">Semestre</th>
            <th style="padding: 3px 6px">Realizadas</th>
            <th style="padding: 3px 6px">Vigentes</th>
            <th style="padding: 3px 6px">Culminadas</th>
            <th style="padding: 3px 6px">Facultad</th>
            <th style="padding: 3px 6px">Creación</th>
        </tr>
        </thead>
        <tbody>
        @foreach($convenios as $i => $convenio)
            <tr>
                <td style="padding: 3px 6px">{{ $i + 1 }}</td>
                <td style="padding: 3px 6px">{{ $convenio->semestre->nombre }}</td>
                <td style="padding: 3px 6px">{{ $convenio->realizados }}</td>
                <td style="padding: 3px 6px">{{ $convenio->vigentes }}</td>
                <td style="padding: 3px 6px">{{ $convenio->culminados }}</td>
                <td style="padding: 3px 6px">{{ $convenio->facultad->nombre }}</td>
                <td style="padding: 3px 6px">{{ $convenio->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p style="font-size: 0.8rem">No hay información sobre Convenios.</p>
    @endif
</main>

</body>

</html>
