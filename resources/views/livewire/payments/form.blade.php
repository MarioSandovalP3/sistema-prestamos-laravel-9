<div wire:ignore.self class="modal fade" id="theModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title text-white">

                    <b>{{ $componentName }}</b> | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}
                </h5>
                <h6 class="text-center text-white" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group" id="Loan" >
                            <label class="font-weight-bold">Prestamo <i class="text-danger">*</i> @error('loanId')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror</label>
                            <div wire:ignore>
                                <select wire:model.lazy="loanId" class="form-control" style="width: 100%"
                                id="select2-dropdown" >
                                <option value="">Seleccione</option>
                                @foreach ($loans as $loan)
                                    <option value="{{ $loan->id }}">{{ $loan->num_loan }} - {{ $loan->partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Fecha <i class="text-danger">*</i> @error('date')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror</label>
                            <input type="date" wire:model.lazy='date' class="ui-autocomplete">
                        </div>
                        
                    </div>
                </div><!-- /row -->

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Pago<i class="text-danger">*</i>
                                @error('to_pay')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input id="numdecimal" type="text" wire:model.blur='to_pay' class="ui-autocomplete">
                        </div>
                    </div>  
                    <div class="col-sm-12 col-md-6"> 
                        <div class="form-group" id="Payments" >
                            <label class="font-weight-bold">Método de pago <i class="text-danger">*</i> @error('paymentId')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror 
                            </label>
                            <div wire:ignore>  
                                <select wire:model.lazy="paymentId" class="form-control" style="width: 100%"
                                id="select2-payment">
                                <option value="">Seleccione</option>
                                <option value="Tarjetas de crédito y débito">Tarjetas de crédito y débito</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Zinli">Zinli</option>
                                <option value="Wally">Wally</option>
                                <option value="Zelle">Zelle</option>
                                <option value="Airtm">Airtm</option>
                                <option value="Advcash">Advcash</option>
                                <option value="Binance Pay">Binance Pay</option>
                                <option value="Mercado Pago">Mercado Pago</option>
                                
                            </select>
                            </div>
                        </div>   
                         
                    </div>         
                </div> <!-- /row -->

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="font-weight-bold">Nota
                            </label>
                            <textarea wire:model="note" class="form-control" rows="5">
                            </textarea>
                        </div>
                    </div>
                </div>

               

            </div>
            <div class="modal-footer">
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
