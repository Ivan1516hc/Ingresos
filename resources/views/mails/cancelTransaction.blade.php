<!doctype html>
<html lang="en">
@php
    $date = new DateTime($transaction->created_at); // Convertimos la fecha en un objeto de fecha
    $date->modify('+2 days'); // Agregamos dos días al objeto de fecha
    $new_date = $date->format('d-m-Y'); // Formateamos la fecha modificada en el formato deseado
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 14px;
        }

        .signature {
            font-style: italic;
        }

        a {
            display: block;
            width: 200px;
            height: 25px;
            background: #418296;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            line-height: 25px;
        }
    </style>
</head>

<body>
    <div>
        <h1><strong>Nueva solicitud de cancelación de movimiento {{ $transaction->invoice }}</strong></h1>
        <p>Nueva solicitud creada por <strong>{{ $transaction->user->name }}</strong>, movimiento realizado el día
            <strong>{{ $transaction->created_at->format('d-m-Y') }}</strong>, fecha limite para aprobación
            <strong>{{ $new_date }}</strong> recuerda que tienes 3 dias desde la creción del movimiento para aprobar
            la cancelación.
        </p>
        @if ($transaction->reason)
            <p>La razón de la solicitud de cancelacion es: <strong>{{ $transaction->reason }}</strong></p>
        @endif

        <p>Folio: <strong>{{ $transaction->invoice }}</strong><br>
            Id beneficiario: <strong>{{ $transaction->beneficiary_id }}</strong><br>
            Nombre beneficiario: <strong>{{ $transaction->beneficiary_name }}</strong><br>
            Centro: <strong>{{ $transaction->location->name }}</strong><br>
            Total: <strong>{{ $transaction->total }}</strong><br></p>
        <a target="_blank" href="http://127.0.0.1:8000/cancelaciones"> Ver Solicitudes de Cancelación</a>
        <div>
            <img src="https://situaciondecalle.difzapopan.gob.mx/assets/images/Logo_DIF.png" width="150px"
                height="150px">
</body>

</html>
