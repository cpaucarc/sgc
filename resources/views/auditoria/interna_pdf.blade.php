<!doctype html>
<html lang="es">

<head>
    <title>Auditoria Interna</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        * {
            font-family: ui-sans-serif, system-ui, Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        @page {
            margin: 50px 60px;
        }

        header {
            border-bottom: 1px solid #DEE2E6;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 85px;
            background-color: white;
        }

        main {
            top: 60px;
        }
    </style>
</head>

<body>

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
<br><br><br><br><br><br><br>
<main>
    <div>
        Auditoria interna PDF
        <br>
        {{ $auditoria_interna }}
        <br>
    </div>
</main>


</body>

</html>
