<div wire:ignore.self class="modal fade" id="theModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title text-white">

                    <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-white" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nombre <i class="text-danger">*</i> @error('name')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='name' class="form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-2 position-partners">
                        <img src="<?php echo asset('storage/partners/' . $image); ?>" alt=" " width="100" height="100"
                            class="img-partners">
                        <div wire:ignore class="form-group custom-input-file">

                            <label class="filelabel" style="width:150px!important;height:160px!important">
                                <i class="fa fa-paperclip"></i>
                                <span class="title" id="miSpan">Agregar una imagen</span>
                                <input class="FileUpload1" id="FileInput" wire:model.lazy="image" name="image"
                                    type="file" accept="image/*" />
                                <img class="preview preview-partners" src=" " alt=" " id="miImagen" />
                            </label>

                        </div>

                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Documento de identidad <i class="text-danger">*</i> @error('cedula')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='cedula' id="numinteger"
                                class="o_input form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-10">
                        <div class="form-group">
                            <label>Dirección <i class="text-danger">*</i> @error('address')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='address' class="o_input form-control w-100">

                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>País</label>
                            <input type="text" wire:model.lazy='contry' class="o_input form-control w-100">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" wire:model.lazy='state' class="o_input form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Ciudad</label>
                            <input type="text" wire:model.lazy='city' class="o_input form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Código postal @error('postal_code')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='postal_code' class="o_input form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Teléfono de contacto <i class="text-danger">*</i> @error('phone')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='phone' class="o_input form-control w-100"
                                id="numinteger">
                        </div>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>WhatsApp @error('movil')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='movil' class="o_input form-control w-100"
                                placeholder="ej. +5801234567">
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Correo <i class="text-danger">*</i>  @error('email')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='email' class="o_input form-control w-100">
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Website @error('website')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="text" wire:model.lazy='website' class="o_input form-control w-100">
                        </div>

                    </div>


                </div>


            </div>
            <div class="modal-footer">
                <div class="mx-auto d-none" wire:loading.class="loader-upload d-flex" wire:target="image">
                    <label>Cargando imagen...</label>
                </div>
                @if ($selected_id < 1)
                    <button type="button" wire:click.prevent="Store()"
                        class="btn btn-border border btn-outline-info btn-responsive close-modal "
                        wire:loading.attr="disabled" wire:target="image">
                        <b>GUARDAR</b>
                    </button>
                @else
                    <button type="button" wire:click.prevent="Update()"
                        class="btn btn-border border btn-outline-info btn-responsive close-modal "
                        wire:loading.attr="disabled" wire:target="image">
                        <b>ACTUALIZAR</b>
                    </button>
                @endif
                <button type="button" wire:click.prevent="resetUI()"
                    class="btn btn-border border btn-link btn-responsive close-modal" data-dismiss="modal">
                    CERRAR
                </button>

                <span wire:loading wire:target="image">
                    <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-body text-center bg-dark">
                                    <div class="spinner-border text-white" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <h3 class="text-white">Subiendo imagen...</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                </span>

                <span wire:loading wire:target="Store">
                    <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-body text-center bg-dark">
                                    <div class="spinner-border text-white" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <h3 class="text-white">Guardando...</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                </span>
                <span wire:loading wire:target="Update">
                    <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">
                                <div class="modal-body text-center bg-dark">
                                    <div class="spinner-border text-white" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <h3 class="text-white">Actualizando...</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                </span>
            </div>
        </div>
    </div>
</div>
