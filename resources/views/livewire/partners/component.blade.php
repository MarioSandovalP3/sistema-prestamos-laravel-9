<div class="row sales layout-top-spacing">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title compo-title">
                    <b>{{ $componentName }}</b> <i>/ {{ $pageTitle }}</i>
                </h4>
                @can('ClienteProveedor_Crear')
                <a href="javascript:void(0)" class="btn btn-lg btn-border border btn-link btn-responsive"
                    data-toggle="modal" data-target="#theModal" onclick="limpiarImagen()">NUEVO</a>
                @endcan
            </div>
            @can('ClienteProveedor_Buscar')
            @include('common.searchbox')
            @endcan
            <div class="widget-content">
                <div class="tablet-responsive">
                    <table class="tablet table-striped mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <thead class="text-white color-thead">
                            <tr class="text-center">
                                <th class="tablet-th text-white ">IMAGEN</th>
                                <th class="tablet-th text-white">NOMBRE</th>
                                <th class="tablet-th text-white">TELEFONO</th>
                                <th class="tablet-th text-white">WHATSAPP</th>
                                <th class="tablet-th text-white">CORREO</th>
                                <th class="tablet-th text-white">DEUDA</th>
                                <th class="tablet-th text-white">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $partner)
                            <tr class="tr-text text-center">
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $partner->imagen) }}" alt="Imagen"
                                        width="50" height="50" class="rounded">
                                </td>
                                <td class="w-25">{{ $partner->name }}</td>
                                <td>{{ $partner->phone }}</td>
                                <td>{{ $partner->movil }}</td>
                                <td class="mt-2">{{ $partner->email }}</td>
                                <td>{{ number_format((float)($partner->debt ?? 0), 2) }}</td>
                                <td class="text-left">
                                    @can('ClienteProveedor_Editar')
                                    <a href="javascript:void(0)" wire:click="Edit({{ $partner->id }})"
                                        class="btn btn-link btn-pos" data-toggle="tooltip" data-placement="top"
                                        title="Editar" onclick="limpiarImagen()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('ClienteProveedor_Eliminar')
                                    <a href="javascript:void(0)" onclick="Confirm('{{ $partner->id }}')"
                                        class="btn btn-link btn-pos" data-toggle="tooltip" data-placement="top"
                                        title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('ClienteProveedor_Editar')
                                    <a href="tel:{{ $partner->phone }}"
                                        onClick="return (navigator.userAgent.match(/Android | iPhone | movile /i),limpiarImagen()) != null;"
                                        class="btn btn-link btn-shop d-lg-none d-md-none btn-pos"
                                        data-toggle="tooltip" data-placement="top" title="Llamar">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                        </svg>
                                    </a>
                                    @if ($partner->movil)
                                    <a href="https://wa.me/{{ $partner->movil }}" target="_BLANK"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Contactar por whatsapp"
                                        class="btn btn-link btn-shop btn-pos">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                        </svg>
                                    </a>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.partners.form')
</div>


 <script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {


         window.livewire.on('show-modal', Msg => {
             $('#theModal').modal('show')

         });
         window.livewire.on('partner-added', Msg => {
             $('#theModal').modal('hide')
             Snackbar.show({
                 pos: 'top-right',
                 actionText: Msg,
                 actionTextColor: '#ffffff',
                 backgroundColor: '#1b55e2'
             });

         });
         window.livewire.on('partner-updated', Msg => {
             $('#theModal').modal('hide')

             Snackbar.show({
                 pos: 'top-right',
                 actionText: Msg,
                 actionTextColor: '#ffffff',
                 backgroundColor: '#1b55e2'
             });
         });

         window.livewire.on('partner-deleted', Msg => {
             Snackbar.show({
                 pos: 'top-right',
                 actionText: Msg,
                 actionTextColor: '#ffffff',
                 backgroundColor: '#d3212d'
             });
         });
         window.livewire.on('partner-error', Msg => {
             Snackbar.show({
                 pos: 'top-right',
                 actionText: Msg,
                 actionTextColor: '#ffffff',
                 backgroundColor: '#d3212d'
             });
         });

     });

     function Confirm(id, products) {

         Swal.fire({
             text: '¿Deseas eliminar el registro?',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Sí',
             cancelButtonText: 'No'

         }).then(function(result) {
             if (result.value) {
                 window.livewire.emit('destroy', id)
                 swal.close()
             }
         })
     }
 </script>
