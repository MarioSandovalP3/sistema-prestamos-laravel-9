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
            font-size: 12px
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
    <?php 
        $fecha = \Carbon\Carbon::parse($loan->date);
        $diaDelMes = $fecha->day;
    ?>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/companies/icons/' . $company->ico) }}" alt="Imagen" width="60" height="60">
            <h2>RECIBO DE PRÉSTAMO DE DINERO</h2>
        </div>
        <div class="content">
            <p>{{ $company->city }}, {{ \Carbon\Carbon::parse($loan->date)->locale(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</p>

            <p>
                El prestamista <b>{{ $company->name }}</b>, con identificación <b>{{ $company->rif }}</b> y domicilio en <b>{{ $company->address }}</b> <b>{{ $company->city }}</b>, certifica que ha entregado <b>{{ $loan->amount_loan }}</b> al prestatario <b>{{ $partner->name }}</b>, con identificación <b>{{ $partner->cedula }}</b> y domicilio en <b>{{ $partner->address }}</b> <b>{{ $partner->state }}</b> <b>{{ $partner->city }}</b>.
            </p>

            <p>
                Este préstamo tiene un interés de <b>{{ $loan->interest_rate_yearly }}%</b> y debe ser devuelto en <b>{{ $loan->installments_total }}</b> @if($loan->payment_frequency=='Mensual')Meses @else <b>Quincenas</b> @endif. El prestatario se compromete a pagar <b>{{ $loan->to_pay }}</b> <b>{{ $loan->payment_frequency }}</b>@if($loan->payment_frequency=='Mensual') el día <b>{{ $diaDelMes }}</b> de cada mes @endif.
            </p>
        </div>

        <div class="content detalles">
            <p style="text-align: center"><b>DETALLES DEL PRESTAMO</b></p>
            <div class="field">
                <span class="label">Fecha de Aceptación:</span>
                <span class="value">{{ \Carbon\Carbon::parse($loan->date)->locale(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale())->isoFormat('LL') }}</span>
            </div>
            <div class="field">
                <span class="label">Tipo de Préstamo:</span>
                <span class="value">{{ $loan->type_loan }}</span>
            </div>
            <div class="field">
                <span class="label">Monto del Préstamo:</span>
                <span class="value">{{ number_format((float)($loan->loan_amount), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Tasa de Interés Anual:</span>
                <span class="value">{{ $loan->interest_rate_yearly }}%</span>
            </div>
            <div class="field">
                <span class="label">Cuota a Pagar:</span>
                <span class="value">{{ number_format((float)($loan->to_pay), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Último Pago:</span>
                <span class="value">{{ number_format((float)($loan->final_payment), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Frecuencia de Pago:</span>
                <span class="value">{{ $loan->payment_frequency }}</span>
            </div>
            <div class="field">
                <span class="label">Número de Cuotas:</span>
                <span class="value">{{ $loan->installments_total }}</span>
            </div>
            <div class="field">
                <span class="label">Total a Pagar:</span>
                <span class="value">{{ number_format((float)($loan->total_to_pay), 2) }}</span>
            </div>
            <div class="field">
                <span class="label">Fechas de pago:</span>
                @php
                use Illuminate\Support\Arr;

                $firstDate = \Carbon\Carbon::parse(Arr::first($loan_dates))->format('d-m-Y');
                $lastDate = \Carbon\Carbon::parse(Arr::last($loan_dates))->format('d-m-Y');
                @endphp

                <span class="value">
                    [Fecha de inicio: <strong>{{ $firstDate }}</strong>], 
                    [Fecha final: <strong>{{ $lastDate }}</strong>]
                </span>
            </div>
        </div>
        <div class="footer">
           
            <table>
                <thead>
                    <tr>
                        <td>
                            <h6>------------------------------------------------------</h6>
                            <p><b>Prestamista: {{ $company->name }}</b></p>
                            <span>{{ $company->rif }}</span>
                        </td>
                        <td>
                            <h6>------------------------------------------------------</h6>
                            <p><b>Prestatario: {{ $partner->name }}</b></p>
                            <span>{{ $partner->cedula }}</span>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h6>------------------------------------------------------</h6>
                            <p style="text-align: left"><b>Testigo 1: </b></p>
                        </td>
                        <td>
                            <h6>------------------------------------------------------</h6>
                            <p style="text-align: left"><b>Testigo 2: </b></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>