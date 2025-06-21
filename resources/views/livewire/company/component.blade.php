<div class="row sales layout-top-spacing">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h2 class="card-title">
                    {{$componentName}}
                </h2>
            </div>
            <div class="widget-content" >
                <div class="row">
                    @foreach($data as $company)
                    @can('Company_Crear')
                    <div class="col-md-4 text-center">
                        <a href="javascript:void(0)" wire:click="Edit({{$company->id}})"  title="Editar" onclick="limpiarImagen()">
                            <img src="{{asset('storage/companies/company.webp')}}" alt="Datos" class="img-fluid" width="200px" height="200px">
                            <h4 class="text-dark">Datos</h4>
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="javascript:void(0)"  wire:click="EditUs({{$company->id}})" title="Editar" >
                            <img src="{{asset('storage/companies/us.webp')}}" alt="US" class="img-fluid" width="200px" height="200px">
                            <h4 class="text-dark">Nosotros</h4>
                        </a>
                    </div>
                   
                    
                    @endcan
                    @endforeach
                </div>
            </div>
            <div>
                @include('livewire.company.us')
            </div>
        </div>
    </div>
    @include('livewire.company.form')
</div>



 <script type="text/javascript">
document.addEventListener('livewire:load', function () {


    window.livewire.on('modal-show', Msg => {
        $('#theModal').modal('show')
    });

    window.livewire.on('company-updated', Msg => {
        $('#theModal').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });

    window.livewire.on('company-error', Msg => {
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#d3212d'
        });
    });


    window.livewire.on('modal-us', Msg => {
        $('#theModalUs').modal('show')
    });

    window.livewire.on('us-updated', Msg => {
        $('#theModalUs').modal('hide')
        Snackbar.show({
            pos: 'top-right',
            actionText: Msg,
            actionTextColor: '#ffffff',
            backgroundColor: '#1b55e2'
        });
    });


    window.livewire.on('clear-imagen', Msg => {
        limpiarImagen();
    });
});

 </script>