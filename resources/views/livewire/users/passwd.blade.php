<div wire:ignore.self  class="modal fade" id="Passwd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">
                    Actualizar contraseña
                </h5>
                <h6 class="text-center text-white" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="text" wire:model.lazy='passwordEdit' class="form-control form-fond">
                            @error('passwordEdit') <span class="text-danger er">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetPasswd()" class="btn text-danger btn-border border btn-link btn-responsive close-modal">
                CERRAR
                </button>
                <button type="button" wire:click.prevent="updatePasswd()" class="btn text-info btn-border border btn-link btn-responsive close-modal" >
                <b>ACTUALIZAR</b>
                </button>
            </div>
        </div>
    </div>
</div>

