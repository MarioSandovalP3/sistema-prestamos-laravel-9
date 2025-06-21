@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Nombre <i class="text-danger">*</i> @error('name') <span class="text-danger er">{{$message}}</span>@enderror</label>
            <input type="text" wire:model.lazy='name' class="form-control">
        </div>
    </div>
    <div class="col-12 col-md-2 position-user">
        <img src="<?php echo asset('storage/users/' . $image)?>" alt=" " width="100" height="100" class="img-partners"> 
        <div  wire:ignore class="form-group custom-input-file" >
            <label class="filelabel" style="width:150px!important;height:160px!important">
            <i class="fa fa-paperclip"></i>
            <span class="title" id="miSpan">Agregar una imagen</span>
            <input class="FileUpload1" id="FileInput" wire:model.lazy="image" name="image" type="file" accept="image/x-png, image/gif, image/jpeg, image/webp"  />
            <img class="preview preview-partners" src=" " alt=" " id="miImagen"/>                
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Teléfono @error('phone') <span class="text-danger er">{{$message}}</span>@enderror</label>
            <input type="text" wire:model.lazy='phone' class="form-control " maxlength="14">
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label>Correo <i class="text-danger">*</i> @error('email') <span class="text-danger er">{{$message}}</span>@enderror</label>
            <input type="text" wire:model.lazy='email' class="form-control  ">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">		
            <label>Contraseña <i class="text-danger">*</i> @error('password') <span class="text-danger er">{{$message}}</span>@enderror</label>	
            <input type="text" wire:model.lazy='password' class="form-control  ">
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Estatus <i class="text-danger">*</i> @error('status') <span class="text-danger er">{{$message}}</span>@enderror</label>
            <select wire:model.lazy="status" class="form-control  ">
                <option value="Seleccione" selected>Seleccione</option>
                <option value="Active">Activo</option>
                <option value="Locked">Bloqueado</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Asignar Role <i class="text-danger">*</i> @error('profile') <span class="text-danger er">{{$message}}</span>@enderror</label>
            <select wire:model.lazy="profile" class="form-control  ">
                <option value="Seleccione" selected>Seleccione</option>
                @foreach($roles as $role)
                <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>



@include('common.modalFooter')

