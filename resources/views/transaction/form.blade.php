<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-10">
                <div id="input-container" class="d-none">
                    <div class="form-group">
                        <label for="bill">FACTURAR</label>
                        <input type="text" name="bill" value="{{ $transaction->bill }}"
                            class="form-control{{ $errors->has('bill') ? ' is-invalid' : '' }}" placeholder="NOMBRE" />
                        @if ($errors->has('bill'))
                            <div class="invalid-feedback">{{ $errors->first('bill') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div>
                    <label>
                        NECESITA FACTURA
                        <input type="checkbox" name="mostrar_input" onchange="mostrarInput(this)">
                    </label>
                </div>
            </div>

            <h5>BENEFICIARIO</h5>

            <div class="col-6">
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

            <h5>SERVICIOS</h5>

            <div class="col-5">
                <select  id="services" class="form-select">
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
        <button type="submit" class="btn btn-primary float-right">GENERAR</button>
    </div>
</div>


@include('pages.modal')

<script src="../../js/transactions.js"></script>
