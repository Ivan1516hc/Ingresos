<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-10">
                @if ($message = Session::get('message'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>

            <h5>BENEFICIARIO</h5>

            <div class="col-3">
                <div class="form-group">
                    <label for="beneficiary_id">ID BENEFICIARIO</label>
                    <input type="text" name="beneficiary_id" id="beneficiary_id"
                        value="{{ $transaction->beneficiary_id }}"
                        class="form-control{{ $errors->has('beneficiary_id') ? ' is-invalid' : '' }}" placeholder="ID"
                        onchange="searchBeneficiary(value)" />
                    @if ($errors->has('beneficiary_id'))
                        <div class="invalid-feedback">{{ $errors->first('beneficiary_id') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="beneficiary_name">NOMBRE BENEFICIARIO</label>
                    <input type="text" name="beneficiary_name" id="beneficiary_name"
                        value="{{ $transaction->beneficiary_name }}"
                        class="form-control{{ $errors->has('beneficiary_name') ? ' is-invalid' : '' }}"
                        placeholder="NOMBRE" />
                    @if ($errors->has('beneficiary_name'))
                        <div class="invalid-feedback">{{ $errors->first('beneficiary_name') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-2">
                <div>
                    <label>
                        NO VINCULANTE
                        <input type="checkbox" onchange="noBildingCheckbox(this)">
                    </label>
                </div>
            </div>

            <h5>SERVICIOS</h5>

            <div class="col-5">
                <select id="services" class="form-select">
                    <option>SELECCIONA SERVICIO</option>
                </select>
            </div>
            <div class="col-2 offset-lg-1">
                <select id="cantidad" class="form-select">
                    <option>CANTIDAD</option>
                    <option value=1>1 UD.</option>
                    @for ($i = 1; $i < 10; $i++)
                        <option value={{ $i + 1 }}>{{ $i + 1 }} UDS.</option>
                    @endfor
                </select>
            </div>
            <div class="col-3 offset-lg-1">
                <button class="btn btn-success btn-md" type="button" onclick="addService()">AGREGAR</button>
            </div>
            <div class="col-12 mt-3 d-none" id="table-container">
                <p class="text-danger" id='labelPartial'>
                </p>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabla-servicios">
                        <thead class="thead">
                        </thead>
                        <tbody id="tabla-servicios">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6 d-none offset-6" id="total-container">
                <div class="form-group">
                    <label for="total">Total: </label>
                    <input type="text" name="total" id="total" value="{{ $transaction->total }}" disabled
                        class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="Total" />
                    @if ($errors->has('total'))
                        <div class="invalid-feedback">{{ $errors->first('total') }}</div>
                    @endif
                </div>
            </div>
            <input type="hidden" name="serviciosAgregados" id="serviciosAgregadosInput">
        </div>
    </div>
    <div class="box-footer mt-2 d-none" id="button">
        <button class="btn btn-primary float-right">GENERAR</button>
    </div>
</div>

<!--Modal: modalPush-->
<div class="modal fade centerModal" id="modalTherapists" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">Terapeutas</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <select id="therapists" name="therapists" class="form-select">
                </select>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <button type="button" onclick="submit()" class="btn btn-primary">Generar Movimiento</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

<!--Modal: modalPush-->
<div class="modal fade centerModal" id="modalPromotores" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">Promotores</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <select id="promoters" name="promoters" class="form-select">
                </select>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <button type="button" onclick="submit()" class="btn btn-primary">Generar Movimiento</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

<div class="modal fade centerModal" id="modalCuotas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">Cuotas</p>
            </div>
            <!--Body-->
            <div class="modal-body row">
                <label for="recipient-name" class="col-form-label">Couta: </label>
                <input type="number" class="form-control" id="cuota" value=0 min=0 name="cuota" disabled>
                <label for="recipient-name" class="col-form-label mt-4">Factura: </label>
                <input type="text" class="form-control" id="bill" name="bill" disabled>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <button type="button" onclick="submit()" class="btn btn-primary">Generar Movimiento</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

<!--Modal: modalPush-->
<div class="modal fade centerModal" id="modalNB" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">No Vinculantes</p>
            </div>
            <!--Body-->
            <div class="modal-body row">
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave1">
                    Menor Masculino
                </label>
                <input type="number" min=0 id="mm" name="mm" class="elemento col-6" disabled>
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave2">
                    Menor Femenino
                </label>
                <input type="number" min=0 id="mf" name="mf" class="elemento col-6" disabled>
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave3">
                    Adulto Masculino
                </label>
                <input type="number" min=0 id="am" name="am" class="elemento col-6" disabled>
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave4">
                    Adulto Femenino
                </label>
                <input type="number" min=0 id="af" name="af" class="elemento col-6" disabled>
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave5">
                    Adulto Mayor Masculino
                </label>
                <input type="number" min=0 id="amm" name="amm" class="elemento col-6" disabled>
                <label class="col-6 mt-1">
                    <input type="checkbox" id="expand-btn" class="checkbox-accion" data-clave="clave6">
                    Adulto Mayor Feminino
                </label>
                <input type="number" min=0 id="amf" name="amf" class="elemento col-6" disabled>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <button type="button" id="btn-generar-movimiento" class="btn btn-primary">Generar
                    Movimiento</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

@include('pages.modal')

<script src="../../js/transactions.js"></script>
