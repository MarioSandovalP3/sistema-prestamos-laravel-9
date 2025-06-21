<div wire:ignore.self class="modal fade" id="theModalUs" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-focus="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title text-white">
                    <b>Nosotros</b> | EDITAR
                </h5>
                <h6 class="text-center text-white" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12"  wire:ignore>
                        <div >
                            <textarea id="us" wire:model="us">
                            </textarea>
                        </div>
                    </div>
                    <div class="p-3">
                        @error('us') <span class="text-danger er">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="Us()" class="btn btn-border border btn-outline-info btn-responsive close-modal">
                <b>GUARDAR</b>
                </button>
                <button type="button" wire:click.prevent="resetUIUs()" class="btn btn-border border btn-link btn-responsive close-modal" data-dismiss="modal">
                CERRAR
                </button>
                <span wire:loading wire:target="Us">
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
<script src="{{ asset('vendor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
    let editor
    ClassicEditor
        .create(document.querySelector('#us'), {
            simpleUpload: {
                // The URL that the image will be uploaded to.
                uploadUrl: '{{ route("image.upload") }}',
                // Add the CSRF token to the headers.
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                    'accept': 'application/json'
                }
            },
        })
        .then(function (leditor) {
            editor = leditor;
            leditor.model.document.on('change:data', () => {
                @this.set('us', leditor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });

    window.livewire.on('clear-us', msg => {
        editor.setData('');
    });

    window.livewire.on('edit-us', msg => {
        editor.setData(msg);
    });


});
 
</script>

  