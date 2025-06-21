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
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group" id="Partner" >
                            <label class="font-weight-bold">Cliente <i class="text-danger">*</i> @error('partnerId')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror</label>
                        
                            <select wire:model.lazy="partnerId" class="form-control" style="width: 100%"
                                id="select2-dropdown" @disabled($selected_id > 0)>
                                <option value="">Seleccione</option>
                                @foreach ($partners as $partner)
                                    <option value="{{ $partner->id }}">{{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>

                            
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label class="font-weight-bold">Fecha <i class="text-danger">*</i> @error('date')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror</label>
                            <input type="date" wire:model.lazy='date' class="ui-autocomplete" @disabled($selected_id > 0 && $debt == 0)>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label class="font-weight-bold">Tipo de prestamo <i class="text-danger">*</i> @error('type_loan')
                                <span class="text-danger er">{{ $message }}</span>
                            @enderror</label>                       
                            <select wire:model.lazy="type_loan" class="ui-autocomplete" style="width: 100%"
                                 @disabled($selected_id > 0 && $debt == 0 && $num_pay > 0)>
                                <option value="">Seleccione</option>
                                <option value="AMORTIZABLE">AMORTIZABLE</option>
                                <option value="INTERES SIMPLE">INTERES SIMPLE</option>
                                <option value="INTERES FIJO">INTERES FIJO</option>
                            </select>                         
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 mt-2 text-center">
                        <h4>Prestamo Nº @if($selected_id > 0 ) {{ $num_loan }} @else {{ $num_loan_new }} @endif</h4>
                        <h4>@if($selected_id > 0 && $debt == 0) <span class="text-primary">Pagado</span> @else <span class="text-warning">Pendiente</span> @endif</h4>
                    </div>
                    
                </div><!-- /row -->

                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Monto del préstamo <i class="text-danger">*</i>
                                @error('loan_amount')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input id="numdecimal" type="text" wire:model.blur='loan_amount' class="form-control" @disabled($selected_id > 0 && $debt == 0)>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Tasa de interés anual <i class="text-danger">*</i>
                                @error('interest_rate_yearly')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input id="numdecimalp" type="text" wire:model.blur='interest_rate_yearly' class="form-control" @disabled($selected_id > 0 && $debt == 0)>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Plazo del préstamo <i class="text-danger">*</i>
                                @error('installments')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <input type="number" id="numinteger" wire:model.blur='installments' class="form-control" @disabled($selected_id > 0 && $debt == 0)>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Modalidad <i class="text-danger">*</i>
                                @error('modality')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <select id="modality" wire:model.blur="modality" class="form-control form-select"
                                name="modality" @disabled($selected_id > 0 && $debt == 0)>
                                <option value="">Seleccione</option>
                                <option value="Años">Años</option>
                                <option value="Meses">Meses</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Frecuencia de pago <i class="text-danger">*</i>
                                @error('payment_frequency')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <select id="payment_frequency" wire:model.blur="payment_frequency"
                                class="form-control form-select" name="payment_frequency" @disabled($selected_id > 0 && $debt == 0)>
                                <option value="">Seleccione</option>
                                <option value="Mensual">Mensual</option>
                                <option value="Quincenal">Quincenal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Tipo de pago <i class="text-danger">*</i>
                                @error('payment_type')
                                    <span class="text-danger er">{{ $message }}</span>
                                @enderror
                            </label>
                            <select id="payment_type" wire:model.lazy="payment_type" class="form-control form-select"
                                name="payment_type" @disabled($selected_id > 0 && $debt == 0)>
                                <option value="">Seleccione</option>
                                <option value="Pago Regular">Pago Regular</option>
                                <option value="Interés + Prestamo al final">Interés + Prestamo al final</option>
                            </select>
                        </div>
                        

                    </div>
                </div> <!-- /row -->

                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label class="font-weight-bold">Nota</label>
                            <textarea wire:model="note" class="form-control" rows="5" @disabled($selected_id > 0 && $debt == 0)>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                      
                            <small class="text-dark"><strong>Pago Regular:</strong> pagar todas las cuotas normalmente.
                            </small><br>
                            <small class="text-dark"><strong>Intereses + Préstamo Final:</strong> pagar solo intereses
                                todos los meses y a la última cuota pagar interés + préstamo</small>
                    </div>
                </div>

                <div class="row p-3 border-top">
                    <div class="col-12">
                        <h4 class="text-center">RESUMEN</h4>
                    </div>
                    <table
                        class="tablet table-striped table-bordered mt-1 col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-1">
                        <thead class="text-white color-thead">
                            <tr class="text-center">
                                <th class="tablet-th text-white">PRESTAMO</th>
                                <th class="tablet-th text-white">TASA ANUAL</th>
                                <th class="tablet-th text-white">Nº DE PAGOS</th>
                                <th class="tablet-th text-white">TASA DE INTERES</th>
                                <th class="tablet-th text-white">CUOTA A PAGAR</th>
                                <th class="tablet-th text-white">CUOTA FINAL</th>
                                <th class="tablet-th text-white">INTERES</th>
                                <th class="tablet-th text-white">TOTAL INTERES</th>
                                <th class="tablet-th text-white">TOTAL A PAGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center text-dark">
                                <td>{{ number_format((float)($loan_amount ?? 0), 2) }}</td>
                                <td>{{ round((float)($interest_rate_yearly ?? 0), 0) }}%</td>
                                <td>{{ $installments_total }}</td>                        
                                <td>{{ number_format((float)($interest_rate ?? 0), 2) }}% @if($payment_frequency!='Seleccione'){{ $payment_frequency }} @endif</td>                          
                                <td>{{ number_format((float)($to_pay ?? 0), 2) }}</td>
                                <td>{{ number_format((float)($final_payment ?? 0), 2) }}</td>                          
                                <td>{{ number_format((float)($interest ?? 0), 2) }} @if($payment_frequency!='Seleccione'){{ $payment_frequency }}@endif</td>                           
                                <td>{{ number_format((float)($total_interest ?? 0), 2) }}</td>                             
                                <td>{{ number_format((float)($total_to_pay ?? 0), 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /row -->

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
                    @if($debt>0)
                        <button type="button" wire:click.prevent="Update()"
                            class="btn btn-border border btn-outline-info btn-responsive close-modal "
                            wire:loading.attr="disabled" wire:target="image">
                            <b>ACTUALIZAR</b>
                        </button>
                    @endif
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
