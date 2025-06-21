 <div class="row sales layout-top-spacing">
 	<div class="col-sm-12">
 		<div class="widget widget-chart-one">
 			<div class="widget-heading">
 				<h4 class="card-title compo-title">
 					<b>{{$componentName}}</b> <i>/ {{$pageTitle}}</i>
 				</h4>
 				<ul class="tabs tab-pills">
          @can('Usuario_Crear')

 						<a href="javascript:void(0)" class="btn btn-lg btn-border border btn-link btn-responsive" data-toggle="modal" data-target="#theModal" onclick="limpiarImagen()">NUEVO</a>

          @endcan
 				</ul>
 			</div>
      @can('Usuario_Buscar')
 			@include('common.searchbox')
      @endcan
 			<div class="widget-content">
 				<div class="tablet-responsive ">
 					<table class="tablet table-striped table-bordered mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
 						<thead class="text-white color-thead">
 							<tr class="text-center">
                <th class="tablet-th text-white">IMAGEN</th>
 								<th class="tablet-th text-white">USUARIO</th>
 								<th class="tablet-th text-white">TELEFONO</th>
 								<th class="tablet-th">CORREO</th>
 								<th class="tablet-th text-white">PERFIL</th>
 								<th class="tablet-th text-white">ESTATUS</th>								
 								<th class="tablet-th text-white">ACCIONS</th>
 							</tr>
 						</thead>
 						<tbody>
 							@foreach($data as $usr)
 							<tr class="tr-text text-center">
                <td class="user">
                  
                    <img src="{{ asset('storage/' .$usr->imagen)}}" alt="Imagen" width="50" class="rounded">
                  
                </td>
 								<td>{{$usr->name}}</td>
 								<td>{{$usr->phone}}</td>
 								<td>{{$usr->email}}</td>
 								<td >{{$usr->profile}}</td>
 								<td >
 									<span class="w-75 badge {{$usr->status == 'Active' ? 'badge-success' : 'badge-danger'}} uppercase">{{$usr->status == 'Active' ? 'Activo' : 'Bloqueado'}}</span>
 								</td>
 								
 								<td>
                  @can('Usuario_Editar')
 									<a href="javascript:void(0)" 
 									wire:click="Edit({{$usr->id}})"
 									class="btn btn-link btn-pos" 
 									data-toggle="tooltip" data-placement="top" title="Editar" 
                  onclick="limpiarImagen()">
 										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
 									</a>
                  @endcan
                  @can('Usuario_Eliminar')
 									<a href="javascript:void(0)" 
 									onclick="Confirm('{{$usr->id}}')" 
 									class="btn btn-link btn-pos" 
 									data-toggle="tooltip" data-placement="top" title="Eliminar">
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
 					{{$data->links()}} 
 				</div>
 			</div>
 		</div>
 	</div>
 	@include('livewire.users.form')
  @include('livewire.users.passwd')

 </div>

<script type="text/javascript">
 	document.addEventListener('DOMContentLoaded', function () {
    window.livewire.on('reset-passwd', Msg => {
        $('#Passwd').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });

    window.livewire.on('close-passwd', Msg => {
        $('#Passwd').modal('hide')
    });

    window.livewire.on('reset-passwd', Msg => {
        $('#theModalPasswd').modal('show')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });

    window.livewire.on('close-passwd', Msg => {
        $('#theModalPasswd').modal('hide')
    });

    window.livewire.on('user-added', Msg => {
        $('#theModal').modal('hide')

    });
    window.livewire.on('user-updated', Msg => {
        $('#theModal').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('user-deleted', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });
    window.livewire.on('user-exists', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });
    window.livewire.on('user-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });
    window.livewire.on('user-whithsales', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });
    window.livewire.on('show-modal', Msg => {
        $('#theModal').modal('show')
    });


});

function Confirm(id) {

    swal({
        text: '¿Deseas eliminar el registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'

    }).then(function (result) {
        if (result.value) {
            window.livewire.emit('destroy', id)
            swal.close()
        }
    })
}
 </script>