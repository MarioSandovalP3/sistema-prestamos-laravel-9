<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title compo-title">
                    <b>{{ $componentName }}</b> <i>/ {{ $pageTitle }}</i>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Usuario_Crear')
                    <a href="javascript:void(0)" class="btn btn-lg btn-border border btn-link btn-responsive"
                        data-toggle="modal" data-target="#theModal">NUEVO</a>
                    @endcan
                </ul>
            </div>
            @can('Usuario_Buscar')
            @include('common.searchbox')
            @endcan
            <div class="widget-content">
                <div class="tablet-responsive " style="font-size: 12px">
                    <table
                        class="tablet table-striped table-bordered mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                        <thead class="text-white color-thead">
                            <tr class="text-center">
                                <th class="tablet-th text-white">PAGO Nº</th>
                                <th class="tablet-th text-white">PRESTAMO</th>
                                <th class="tablet-th text-white">FECHA</th>
                                <th class="tablet-th text-white">CUOTA PAGO</th>
                                <th class="tablet-th text-white">MÉTODO DE PAGO</th>
                                <th class="tablet-th text-white">COMPROBANTE</th>
                                <th class="tablet-th text-white">NOTIFICACIÓN</th>
                                <th class="tablet-th text-white">ESTATUS</th>
                                <th class="tablet-th text-white">ACCIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr class="text-dark text-center">
                                <td>{{ $payment->num_pay }}</td>
                                <td class="text-center">{{ $payment->loan->num_loan }} - {{ $payment->loan->partner->name }}</td>
                                <td>{{\Carbon\Carbon::parse($payment->date)->format('d-m-Y')}}</td>
                                <td>{{ number_format((float)($payment->to_pay ?? 0), 2) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>
                                    @if($payment->status != 'Anulado')
                                    <a href="{{url('voucher/pdf'.'/'.$payment->id)}}" class="btn btn-link btn-border border btn-inline btn-sm m-1 p-1 w-100" target="_blank">
                                    Generar PDF
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->status != 'Anulado')
                                    @if($payment->email_verification!='PENDIENTE')
                                    <span class="w-75 badge 
                                        @if($payment->email_verification == 'ENVIADO') badge-success 
                                        @elseif($payment->email_verification == 'PENDIENTE') badge-warning 
                                        @elseif($payment->email_verification == 'FALLIDO') badge-danger
                                        @endif
                                        ">
                                    @if($payment->email_verification == 'PENDIENTE')
                                    Pendiente
                                    @elseif($payment->email_verification == 'FALLIDO')
                                    Fallido
                                    @elseif($payment->email_verification == 'ENVIADO')
                                    Enviado
                                    @endif
                                    </span>
                                    @else
                                    <a href="javascript:void(0)" 
                                        class="btn btn-link btn-border border btn-inline btn-sm m-1 p-1 w-100" 
                                        title="Enviar correo" wire:click.prevent="emailVoucher('{{$payment->id}}')">
                                    Enviar correo
                                    </a>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    <span class="w-75 m-2 badge 
                                        @if($payment->status == 'Registrado') badge-success 
                                        @elseif($payment->status == 'Anulado') badge-danger
                                        @endif
                                        ">
                                    @if($payment->status == 'Registrado')
                                    Registrado
                                    @elseif($payment->status == 'Anulado')
                                    Anulado
                                    @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    @can('Usuario_Eliminar')
                                    <a href="javascript:void(0)"
                                    @if($payment->status != 'Anulado')
                                    onclick="Confirm('{{$payment->id}}')"
                                    class="btn btn-link btn-pos"
                                    @else
                                    class="btn btn-link btn-pos disabled"
                                    @endif
                                    title="Anular pago"
                                    @disabled($payment->status == 'Anulado')>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.payments.form')
    <span wire:loading wire:target="emailVoucher">
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center bg-dark">
                        <div class="spinner-border text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h3 class="text-white">Enviando correo...</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    </span>
</div>

 <script type="text/javascript">
     document.addEventListener('livewire:load', function () {
    $(document).ready(function () {

        $('#select2-dropdown').select2({
            dropdownParent: $('#Loan')
        });

        $('#select2-dropdown').on('change', function (e) {
            var loan_id = $('#select2-dropdown').select2("val");
            var loan_name = $('#select2-dropdown option:selected').text();
            @this.set('loanId', loan_id);
            @this.set('loanName', loan_name);


        });
        window.livewire.on('reset-loan', Msg => {
            $('#select2-dropdown').select2("");
        });
    });

    window.livewire.on('set-loan', Msg => {
        $('#select2-dropdown').select2({
            dropdownParent: $('#Loan')
        });
        $('#select2-dropdown').select2(Msg);
    });


    /** Payments **/
    $(document).ready(function () {

        $('#select2-payment').select2({
            dropdownParent: $('#Payments')
        });

        $('#select2-payment').on('change', function (e) {
            var payment_id = $('#select2-payment').select2("val");
            var payment_name = $('#select2-payment option:selected').text();
            @this.set('paymentId', payment_id);
            @this.set('paymentName', payment_name);


        });
        window.livewire.on('reset-payment', Msg => {
            $('#select2-payment').select2("");
        });
    });

    window.livewire.on('set-payment', Msg => {
        $('#select2-payment').select2({
            dropdownParent: $('#Payments')
        });
        $('#select2-payment').select2(Msg);
    });


    window.livewire.on('show-modal', Msg => {
        $('#theModal').modal('show')
        $('#select2-dropdown').select2({
            dropdownParent: $('#Loan')
        });
        $('#select2-payment').select2({
            dropdownParent: $('#Payments')
        });
    });

    window.livewire.on('payment-added', Msg => {
        $('#theModal').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('payment-email', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('payment-updated', Msg => {
        $('#theModal').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('payment-cancel', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('payment-deleted', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('payment-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });

});

function Confirm(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Anular pago",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Anular!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('cancelPay', id)
            swal.close()
        }
    });
}


function emailPDF(id) {

    Swal.fire({
        title: "¿Estás seguro?",
        text: "Enviar el comprobante por correo electronico",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Enviar!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.livewire.emit('emailPDF', id)
            swal.close()
        }
    });
}
 </script>
