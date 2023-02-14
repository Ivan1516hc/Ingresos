<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-2">
                <div>
                    <label>
                        NECESITA FACTURA
                        <input type="checkbox" name="mostrar_input" onchange="mostrarInput(this)">
                    </label>
                </div>
            </div>
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
            <div class="col-6">
                <select name="services" id="services">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>NOMBRE</th>
                                <th>COSTO</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" name="total" value="{{ $transaction->total }}"
                        class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="Total" />
                    @if ($errors->has('total'))
                        <div class="invalid-feedback">{{ $errors->first('total') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">GENERAR</button>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        getServices();
    });

    function mostrarInput(checkbox) {
        var inputContainer = document.getElementById("input-container");
        if (checkbox.checked) {
            inputContainer.classList.remove("d-none");
        } else {
            inputContainer.classList.add("d-none");
        }
    }

    function searchBeneficiary(id) {
        axios.get('http://datac.difzapopan.gob.mx/api-servicios/public/api/1111112022/get/' + id)
            .then(response => {
                console.log(response);
                const data = response.data;
                if (data.iddifzapopan) {
                    document.getElementById("beneficiary_id").value = data.iddifzapopan;
                    document.getElementById("beneficiary_name").value =
                        `${data.nombre} ${data.apaterno} ${data.amaterno ?? ''}`;
                }
            })
            .catch(error => {
                console.error(error);
                document.getElementById("beneficiary_id").value = '';
                document.getElementById("beneficiary_name").value = '';
            })
    }

    function getServices() {
        axios.get('http://127.0.0.1:8000/servicios-usuario')
            .then(response => {
                const services = response.data.data;
            })
            .catch(error => console.error(error))
    }
</script>
