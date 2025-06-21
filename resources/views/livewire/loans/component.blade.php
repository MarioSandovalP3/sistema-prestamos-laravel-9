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
                             data-toggle="modal" data-target="#theModal" onclick="limpiarImagen()">NUEVO</a>
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
                                <th class="tablet-th text-white">Nº</th>
                                <th class="tablet-th text-white">FECHA</th>
                                 <th class="tablet-th text-white">CLIENTE</th>
                                 <th class="tablet-th text-white">TIPO</th>
                                 <th class="tablet-th text-white">PRESTAMO</th>
                                 <th class="tablet-th text-white">Nº PAGOS</th>
                                 <th class="tablet-th text-white">PAGOS</th>
                                 <th class="tablet-th text-white">CUOTA</th>
                                 <th class="tablet-th text-white">CUOTA FINAL</th>
                                 <th class="tablet-th text-white">A PAGAR</th>
                                 <th class="tablet-th text-white">PAGADO</th>
                                 <th class="tablet-th text-white">DEUDA</th>
                                 <th class="tablet-th text-white">ESTADO</th>
                                 <th class="tablet-th text-white">COMPROBANTE</th>
                                 <th class="tablet-th text-white">NOTIFICACIÓN</th>
                                 <th class="tablet-th text-white">ACCIONS</th>
                             </tr>
                         </thead>
                         <tbody>
                             
                                 @foreach ($loans as $loan)
                                 <tr class="text-dark text-center">
                                 <td>{{ $loan->num_loan }}</td>
                                 <td>{{\Carbon\Carbon::parse($loan->date)->format('d-m-Y')}}</td>
                                     <td>{{ $loan->partner->name }}</td>
                                     <td>{{ $loan->type_loan }}</td>
                                     <td>{{ number_format((float)($loan->loan_amount ?? 0), 2) }}</td>
                                     <td>{{ $loan->installments_total }}</td>
                                     <td>{{ $loan->num_pay }}</td>
                                     <td>{{ number_format((float)($loan->to_pay ?? 0), 2) }}</td>
                                     <td>{{ number_format((float)($loan->final_payment ?? 0), 2) }}</td> 
                                     <td>{{ number_format((float)($loan->total_to_pay ?? 0), 2) }}</td>
                                     <td>{{ number_format((float)($loan->total_pay ?? 0), 2) }}</td>
                                     <td>{{ number_format((float)($loan->debt ?? 0), 2) }}</td>
                                     <td>
                                            <span class="w-100 badge 
                                            @if($loan->status == 'Pagado') badge-success 
                                            @elseif($loan->status == 'Pendiente') badge-warning 
                                            @elseif($loan->status == 'Cancelado') badge-danger
                                            @endif
                                            ">
                                            @if($loan->status == 'Pagado')
                                            Pagado
                                            @elseif($loan->status == 'Pendiente')
                                            Pendiente
                                            @elseif($loan->status == 'Cancelado')
                                            Cancelado
                                            @endif
                                            </span>
                                    </td>
                                     <td>
                                        <a href="{{url('receipt-loan/pdf'.'/'.$loan->id)}}" class="btn btn-link btn-border border btn-inline btn-sm m-1 p-1 w-100" target="_blank">
                                            Generar PDF
                                        </a>
                                        
                                    </td>
                                     <td>
                                        @if($loan->email_verification!='PENDIENTE')
                                        <span class="w-75 badge 
                                            @if($loan->email_verification == 'ENVIADO') badge-success 
                                            @elseif($loan->email_verification == 'FALLIDO') badge-danger
                                            @endif
                                            ">
                                            @if($loan->email_verification == 'FALLIDO')
                                            Fallido
                                            @elseif($loan->email_verification == 'ENVIADO')
                                            Enviado
                                            @endif
                                        </span>
                                        @else
                                        <a href="javascript:void(0)" 
                                            class="btn btn-link btn-border border btn-inline btn-sm m-1 p-1 w-100" 
                                            title="Enviar correo" wire:click.prevent="emailPDF('{{$loan->id}}')">
                                            Enviar correo
                                        </a>
                                        @endif
                                    </td>
                                     
                                    <td class="text-center">
                                        @can('Usuario_Editar')
                                        <a href="javascript:void(0)" 
                                            wire:click="Edit({{$loan->id}})"
                                            class="btn btn-link btn-pos" 
                                            title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                          </svg>
                                                           </a>
                                        @endcan
                                        @can('Usuario_Eliminar')
                                        <a href="javascript:void(0)" 
                                            
                                            @if($loan->status != 'Pagado')
                                                onclick="Confirm('{{$loan->id}}','{{$loan->payments->count()}}')"
                                                class="btn btn-link btn-pos"
                                            @else
                                                class="btn btn-link btn-pos disabled"
                                            @endif
                                            title="Eliminar"
                                            @disabled($loan->status == 'Pagado')>
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
                     {{ $loans->links() }}
                 </div>
             </div>
         </div>
     </div>
     @include('livewire.loans.form')
     <span wire:loading wire:target="emailPDF">
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
            dropdownParent: $('#Partner')
        });

        $('#select2-dropdown').on('change', function (e) {
            var partid = $('#select2-dropdown').select2("val");
            var partname = $('#select2-dropdown option:selected').text();
            @this.set('partnerId', partid);
            @this.set('partnerName', partname);

        });
        window.livewire.on('reset-partner', Msg => {
            $('#select2-dropdown').select2("");
        });

        // Cuando se selecciona un valor en select2
        $('#select2-dropdown').on('change', function (e) {
            var selectedValue = $(this).val();

            // Emite el valor seleccionado a Livewire
            Livewire.emit('selectedPartner', selectedValue);
        });

        // Escucha el evento de Livewire para actualizar select2
        Livewire.on('setSelectedPartner', (value) => {
            $('#select2-dropdown').val(value).trigger('change');
        });

        // Hook para procesar cuando Livewire renderiza
        Livewire.hook('message.processed', (message, component) => {
            // Reinicializa select2 después de que Livewire actualiza la lista
            $('#select2-dropdown').select2();
        });

    });

    window.livewire.on('set-partner', Msg => {
        $('#select2-dropdown').select2({
            dropdownParent: $('#Partner')
        });
        $('#select2-dropdown').select2(Msg);
    });


    window.livewire.on('show-modal', Msg => {
        $('#theModal').modal('show')
        $('#select2-dropdown').select2({
            dropdownParent: $('#Partner')
        });
    });

    window.livewire.on('loan-added', Msg => {
        $('#theModal').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('loan-updated', Msg => {
        $('#theModal').modal('hide')
    });
    window.livewire.on('loan-cancel', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('loan-email', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('loan-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });

});

function Confirm(id, payments) {
    if (payments > 0) {

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "No se puede eliminar, tiene pagos registrados!",
        });
    } else {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Eliminar prestamo",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.livewire.emit('destroy', id)
                swal.close()
            }
        });
    }
}
 </script>
