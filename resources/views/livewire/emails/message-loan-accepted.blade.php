<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Préstamo Aceptado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            color: black;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #777;
        }
        .field {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
        }
        .value {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/companies/icons/' . $msn_loan['company_ico']) }}" alt="Imagen" width="60" height="60">
            <h1>Préstamo Aceptado</h1>
        </div>
        <div class="content">
            <p>Estimado/a <span class="value">{{ $msn_loan['partner'] }}</span>,</p>
            <p>Nos complace informarle que su solicitud de préstamo ha sido aceptada con los siguientes detalles:</p>
            <div class="field">
                <span class="label">Fecha de Aceptación:</span>
                <span class="value">{{ \Carbon\Carbon::parse($msn_loan['date'])->locale(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</span>
            </div>
            <div class="field">
                <span class="label">Tipo de Préstamo:</span>
                <span class="value">{{ $msn_loan['type_loan'] }}</span>
            </div>
            <div class="field">
                <span class="label">Monto del Préstamo:</span>
                <span class="value">{{ number_format((float)($msn_loan['loan_amount']), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Tasa de Interés Anual:</span>
                <span class="value">{{ $msn_loan['interest_rate_yearly'] }}%</span>
            </div>
            <div class="field">
                <span class="label">Cuota a Pagar:</span>
                <span class="value">{{ number_format((float)($msn_loan['to_pay']), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Último Pago:</span>
                <span class="value">{{ number_format((float)($msn_loan['final_payment']), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Frecuencia de Pago:</span>
                <span class="value">{{ $msn_loan['payment_frequency'] }}</span>
            </div>
            <div class="field">
                <span class="label">Número de Cuotas:</span>
                <span class="value">{{ $msn_loan['installments'] }}</span>
            </div>
            <div class="field">
                <span class="label">Total a Pagar:</span>
                <span class="value">{{ number_format((float)($msn_loan['total_to_pay']), 2) }}</span>
            </div>
            <div class="field">
                @php
                use Illuminate\Support\Arr;

                $firstDate = \Carbon\Carbon::parse(Arr::first($msn_loan['loan_dates']))->format('d-m-Y');
                $lastDate = \Carbon\Carbon::parse(Arr::last($msn_loan['loan_dates']))->format('d-m-Y');
                @endphp

                <span class="label">Fechas de pago:</span>
                <span class="value">
                    [Fecha de inicio: <strong>{{ $firstDate }}</strong>], 
                    [Fecha final: <strong>{{ $lastDate }}</strong>]
                </span>
            </div>
            <p>Atentamente,</p>
            <p><span class="value">{{ $msn_loan['user'] }}</span></p>
        </div>
        <div class="footer">
            <p>Este es un mensaje automático. Por favor, no responda a este correo.</p>
        </div>
    </div>
</body>
</html>