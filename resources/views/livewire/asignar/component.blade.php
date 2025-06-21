<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title compo-title">
                    <b>{{$componentName}}</b>
                </h4>
            </div>
            <div class="widget-content">
                <div class="form-inline">
                    <div class="form-group mr-5">
                        <select wire:model="role" class="form-control">
                            <option value="Seleccione" selected>Seleccione el role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}" selected>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click.prevent="SyncAll()" type="button" class="btn btn-link btn-border border mbmobile inline mr-5">Seleccionar todos</button>
                    <button onclick="Revocar()" type="button" class="btn btn-link btn-border border mbmobile mr-5">Revocar todos</button>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="tablet-responsive ">
                            <table class="tablet table-striped table-bordered mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                                <thead class="text-white color-thead">
                                    <tr class="text-center">
                                        <th class="tablet-th text-white">ID</th>
                                        <th class="tablet-th text-white">PERMISO</th>
                                        <th class="tablet-th text-white">ROLES CON EL PERMISO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permisos as $permiso)
                                    <tr class="tr-text">
                                        <td>{{$permiso->id}}</td>
                                        <td class="text-left">
                                            <div class="n-check">
                                                <label class="new-control new-checkbox checkbox-primay">
                                                <input type="checkbox"
                                                wire:change="SyncPermiso($('#p' + {{$permiso->id}}).is(':checked'),'{{$permiso->name}}')"
                                                id="p{{$permiso->id}}"
                                                value="{{$permiso->id}}" 
                                                class="new-control-input" {{ $permiso->checked == 1 ? 'checked' : ''}} >
                                                <span class="new-control-indicator"></span>
                                                {{$permiso->name}}
                                                </label>
                                            </div>
                                        </td>
                                        <td class="w-25 text-center">
                                            {{ \App\Models\User::permission($permiso->name)->count()}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$permisos->links()}} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.permisos.form')
</div>

<script type="text/javascript">
 	document.addEventListener('DOMContentLoaded', function () {

    window.livewire.on('sync-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });
    window.livewire.on('permi', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2 '
        });
    });
    window.livewire.on('permi-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });
    window.livewire.on('syncall', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2 '
        });
    });
    window.livewire.on('removeall', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2 '
        });
    });
    window.livewire.on('refresh-sidebar', Msg => {

        $("#compactSidebar").load(location.href + " #compactSidebar>*", "");
    });


});

function Revocar() {
    //console.log('Revocar function called'); // Debug log

    Swal.fire({
        title: 'CONFIRMAR',
        text: 'CONFIRMAS REVOCAR TODOS LOS PERMISOS?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
        cancelButtonColor: '#d3212d',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#1b55e2'
    }).then(function (result) {
        console.log('SweetAlert result:', result); // Debug log

        if (result.value) {
            //console.log('Emitting revokeall event'); // Debug log
            window.livewire.emit('revokeall')
            Swal.close()
        }
    })
}

 </script>
