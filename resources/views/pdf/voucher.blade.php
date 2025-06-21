<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante De Préstamo</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            color: black;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .footer {
            text-align: center;
            color: #0f0f0f;
            font-size: 12px
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
        table{
            padding: 2rem;
            text-align: center
        }
        td{
            padding: 2rem 3.5rem 
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/companies/icons/' . $company->ico) }}" alt="Imagen" width="60" height="60">
            <h2>COMPROBANTE DE PAGO</h2>
        </div>
        <div class="content">
			<p>Estimado/a <span class="value">{{ $partner->name }}</span>,</p>
            <p>Hemos recibido su pago <strong>Nº {{ $payment->num_pay }}</strong> correspondiente al préstamo <strong>Nº {{ $loan->num_loan }}</strong>.</p>
        </div>

        <div class="content">
            <p style="text-align: center"><strong>DETALLES DEL PAGO</strong></p>
            <div class="field">
                <span class="label">Fecha:</span>
                <span class="value">{{ \Carbon\Carbon::parse($payment->date)->locale(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</span>
            </div>
			<div class="field">
                <span class="label">Prestamo Nº:</span>
                <span class="value">{{ $loan->num_loan }}</span>
            </div>
            <div class="field">
                <span class="label">Monto pagado:</span>
                <span class="value">{{ number_format((float)($payment->to_pay), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Método de pago:</span>
                <span class="value">{{ $payment->payment_method }}</span>
            </div>
			<div class="field">
                <span class="label">Total pagado:</span>
                <span class="value">{{ number_format((float)($payment->total_pay), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Pagos restantes:</span>
                <span class="value">{{ $payment->remaining_payments }}</span>
            </div>
            <div class="field">
                <span class="label">Pagos anulados:</span>
                <span class="value">{{ $num_pay_anul }}</span>
            </div>
			<div class="field">
                <span class="label">Deuda:</span>
                <span class="value">{{ number_format((float)($payment->debt), 2) }}</span>
            </div>
        </div>
    </div>
</body>
</html>