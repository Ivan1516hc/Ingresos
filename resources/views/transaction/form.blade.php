<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-10">
                <div id="input-container" class="d-none">
                    <div class="form-group">
                        <label for="bill">FACTURAR</label>
                        <input type="text" name="bill" value="{{ $transaction->bill }}" class="form-control{{ $errors->has('bill') ? ' is-invalid' : '' }}" placeholder="NOMBRE" />
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
                    <input type="text" name="beneficiary_id" id="beneficiary_id" value="{{ $transaction->beneficiary_id }}" class="form-control{{ $errors->has('beneficiary_id') ? ' is-invalid' : '' }}" placeholder="ID" onchange="searchBeneficiary(value)" />
                    @if ($errors->has('beneficiary_id'))
                    <div class="invalid-feedback">{{ $errors->first('beneficiary_id') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="beneficiary_name">NOMBRE BENEFICIARIO</label>
                    <input type="text" name="beneficiary_name" id="beneficiary_name" value="{{ $transaction->beneficiary_name }}" class="form-control{{ $errors->has('beneficiary_name') ? ' is-invalid' : '' }}" placeholder="NOMBRE" />
                    @if ($errors->has('beneficiary_name'))
                    <div class="invalid-feedback">{{ $errors->first('beneficiary_name') }}</div>
                    @endif
                </div>
            </div>

            <h5>SERVICIOS</h5>

            <div class="col-5">
                <select name="services" id="services" class="form-select">
                    <option>SELECCIONA SERVICIO</option>
                </select>
            </div>
            <div class="col-2 offset-lg-1">
                <select name="cantidad" id="cantidad" class="form-select">
                    <option>CANTIDAD</option>
                    <option value=1>1 UD.</option>
                    @for ($i = 1; $i < 10; $i++) <option value={{$i+1}}>{{$i+1}} UDS.</option>
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
                            <tr>
                                <th>No</th>
                                <th>Service</th>
                                <th>Cantidad</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabla-servicios">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-6 d-none offset-6" id="total-container">
                <div class="form-group">
                    <label for="total">Total: </label>
                    <input type="text" name="total" id="total" value="{{ $transaction->total }}" disabled class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" placeholder="Total" />
                    @if ($errors->has('total'))
                    <div class="invalid-feedback">{{ $errors->first('total') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2 d-none" id="button">
        <button type="submit" class="btn btn-primary float-right">GENERAR</button>
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
                let select = document.getElementById("services");
                for (var i = 0; i < response.data.length; i++) {
                    var opt = response.data[i];
                    var el = document.createElement("option");
                    el.textContent = opt.name;
                    el.value = opt.id + "," + opt.name + "," + opt.cost + "," + opt.not_binding + "," + opt.partial;
                    select.add(el);
                }
            })
            .catch(error => console.error(error))
    }
    var serviciosAgregados = [];

    function addService() {
        // Obtener los valores seleccionados de los select
        var servicio = document.getElementById("services").value;
        var cant = document.getElementById("cantidad").value;
        var valores = servicio.split(',');

        // Verificar si se seleccionó un servicio válido
        if (servicio == "SELECCIONA SERVICIO") {
            alert("Selecciona un servicio válido");
            return;
        }

        // Verificar si se seleccionó una cantidad válida
        if (cantidad == "CANTIDAD") {
            alert("Selecciona una cantidad válida");
            return;
        }
        // Agregar el servicio a la variable global
        serviciosAgregados.push({
            id: valores[0],
            name: valores[1],
            cost: valores[2],
            not_binding: valores[3],
            partial: valores[4],
            cant: cant
        });

        // Limpiar los valores seleccionados de los select
        document.getElementById("services").value = "SELECCIONA SERVICIO";
        document.getElementById("cantidad").value = "CANTIDAD";

        // Actualizar la tabla con los servicios agregados
        actualizarTabla();
    }

    // Función para actualizar la tabla con los servicios agregados
    function actualizarTabla() {
        // Obtener la referencia a la tabla
        var tabla = document.getElementById("tabla-servicios");
        // Limpiar la tabla
        tabla.innerHTML = "";
        if (serviciosAgregados.length >= 1) {
            var tableContainer = document.getElementById("table-container");
            var totalContainer = document.getElementById("total-container");
            var button = document.getElementById("button");
            tableContainer.classList.remove("d-none");
            totalContainer.classList.remove("d-none");
            button.classList.remove("d-none");
        } else {
            ableContainer.classList.add("d-none");
            totalContainer.classList.add("d-none");
            button.classList.add("d-none");
        }

        // Agregar los encabezados de la tabla
        var header = tabla.createTHead();
        var row = header.insertRow(0);
        var th1 = document.createElement("th");
        var th2 = document.createElement("th");
        var th3 = document.createElement("th");
        var th4 = document.createElement("th");
        var th5 = document.createElement("th");
        var th6 = document.createElement("th");
        th1.innerHTML = "No.";
        th2.innerHTML = "Nombre";
        th3.innerHTML = "Costo";
        th4.innerHTML = "Cantidad";
        th5.innerHTML = "Total";
        th6.innerHTML = "";
        row.appendChild(th1);
        row.appendChild(th2);
        row.appendChild(th3);
        row.appendChild(th4);
        row.appendChild(th5);
        row.appendChild(th6);
        
        let total=0;

        // Crear una nueva fila para cada servicio agregado y agregarla a la tabla
        for (var i = 0; i < serviciosAgregados.length; i++) {
            
            var servicio = serviciosAgregados[i];
            var fila = tabla.insertRow();
            var celdaNo = fila.insertCell(0);
            var celdaNombre = fila.insertCell(1);
            var celdaCosto = fila.insertCell(2);
            var celdaCantidad = fila.insertCell(3);
            var celdaTotal = fila.insertCell(4);
            var celdaEliminar = fila.insertCell(5); // Agregar celda para botón de eliminar

            celdaNo.innerHTML = i + 1;
            celdaNombre.innerHTML = servicio.name;
            celdaCosto.innerHTML = servicio.cost;
            celdaCantidad.innerHTML = servicio.cant;
            celdaTotal.innerHTML = servicio.cant * servicio.cost;

            total += servicio.cant * servicio.cost;

            // Agregar botón de eliminar y su funcionalidad
            var btnEliminar = document.createElement("button");
            btnEliminar.innerHTML = "Eliminar";
            btnEliminar.dataset.index = i;
            btnEliminar.classList.add("btn", "btn-danger", "btn-sm");
            btnEliminar.addEventListener("click", function() {
                var index = this.dataset.index;
                serviciosAgregados.splice(index, 1);
                actualizarTabla();
            });
            celdaEliminar.appendChild(btnEliminar);
        }

        document.getElementById("total").value =total;

    }

    function eliminarServicio(indice) {
        serviciosAgregados.splice(indice, 1);
        actualizarTabla();
    }

</script>