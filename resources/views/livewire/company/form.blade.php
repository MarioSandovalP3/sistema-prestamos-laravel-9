<div wire:ignore.self  class="modal fade" id="theModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header header-modal">
            <h5 class="modal-title text-white">
                <b>{{$componentName}}</b> | EDITAR
            </h5>
            <h6 class="text-center text-white" wire:loading>POR FAVOR ESPERE</h6>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <label>Nombre <i class="text-danger">*</i> @error('name') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='name' class="ui-autocomplete ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="form-group">
                        <label>Dirección <i class="text-danger">*</i> @error('address') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='address' class="ui-autocomplete ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Ciudad <i class="text-danger">*</i> @error('city') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='city' class="ui-autocomplete ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Estado <i class="text-danger">*</i> @error('state') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='state' class="ui-autocomplete ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Teléfono <i class="text-danger">*</i> @error('phone') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='phone' class="ui-autocomplete ">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Whatsapp @error('movil') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='movil' class="ui-autocomplete " placeholder=" +58XXXXXXXXXX">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Código postal @error('postal_code') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='postal_code' class="ui-autocomplete">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Rif @error('rif') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='rif' class="ui-autocomplete">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Sitio Web @error('website') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='website' class="ui-autocomplete">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Correo <i class="text-danger">*</i> @error('email') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='email' id="email" class="ui-autocomplete">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div wire:ignore  class="form-group">
                        <label>Eslogan @error('us') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <input type="text" wire:model.lazy='slogan' class="ui-autocomplete" id="slogan" maxlength="160">
                        <span>Máximo </span><span wire:ignore id="characterCount">0 / 160 caracteres</span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-10">
                    <div wire:ignore  class="form-group">
                        <label>Incorporar un mapa @error('iframe_map') <span class="text-danger er">{{$message}}</span>@enderror</label>
                        <textarea wire:model='iframe_map' rows="2" class="form-control" id="iframe_map" placeholder="Pegue aquí el código iframe del mapa">
                        </textarea>
                    </div>
                </div>
                <div class="col-12 col-md-2 position-company">
                    <label>Logo @error('image') <span class="text-danger er">{{$message}}</span>@enderror</label>
                    <img src="<?php echo asset('storage/companies/' . $image)?>" alt=" " width="100" height="100" class="img-company"> 
                    <div  wire:ignore class="form-group custom-input-file" >
                        <label class="filelabel" style="width:180px!important;height:180px!important">
                        <i class="fa fa-paperclip"></i>
                        <span class="title" id="miSpan">Logo</span>
                        <input class="FileUpload1" id="FileInput" wire:model.lazy="image" name="image" type="file" accept="image/x-png, image/gif, image/jpeg, image/webp"  />
                        <img class="preview preview-company" src=" " alt=" " id="miImagen"/>                
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="mx-auto d-none" wire:loading.class="loader-upload d-flex" wire:target="image">
                    <label>Cargando imagen...</label>
                </div>
                <button type="button" wire:click.prevent="Update()"  class="btn btn-border border btn-outline-info btn-responsive close-modal " wire:loading.attr="disabled" wire:target="image">
                <b>ACTUALIZAR</b>
                </button>
                <button type="button" wire:click.prevent="resetUI()" class="btn btn-border border btn-link btn-responsive close-modal" data-dismiss="modal" >
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
<script type="text/javascript">
    const input = document.getElementById('slogan');  
    const counter = document.getElementById('characterCount'); 
    input.addEventListener('input', function() { 
    	const count = input.value.length;
    	counter.textContent = count + ' / 160';
    });  
</script>
