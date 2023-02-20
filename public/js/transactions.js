window.addEventListener('DOMContentLoaded', () => {
    getServices();

});
let serviciosAgregados = [];


function mostrarInput(checkbox) {
    let inputContainer = document.getElementById("input-container");
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
            for (let i = 0; i < response.data.length; i++) {
                let opt = response.data[i];
                let el = document.createElement("option");
                el.textContent = opt.name;
                el.value = JSON.stringify({ id: opt.id, name: opt.name, cost: opt.cost, opt: opt.not_binding, partial: opt.partial, cant: '' });
                select.add(el);
            }
        })
        .catch(error => console.error(error))
}


function addService() {
    // Obtener los valores seleccionados de los select
    // Verificar si se seleccionó un servicio válido
    let value = document.getElementById("services").value;
    if (value == 'SELECCIONA SERVICIO') {
        alert("Selecciona un servicio válido");
        return;
    }
    let servicio = JSON.parse(value);
    servicio.cant = document.getElementById("cantidad").value;
    servicio.total = servicio.cant * servicio.cost;



    // Verificar si se seleccionó una cantidad válida
    if (servicio.cant == "CANTIDAD") {
        alert("Selecciona una cantidad válida");
        return;
    }

    if (serviciosAgregados.length >= 1 && servicio.partial == 1) {
        let modal = document.getElementById('exampleModal');
        let openModal = new bootstrap.Modal(modal);
        return openModal.show();
    }

    // Agregar el servicio a la letiable global

    serviciosAgregados.push(servicio);

    // Limpiar los valores seleccionados de los select
    document.getElementById("services").value = "SELECCIONA SERVICIO";
    document.getElementById("cantidad").value = "CANTIDAD";

    // Actualizar la tabla con los servicios agregados
    actualizarTabla();
}

// Función para actualizar la tabla con los servicios agregados
function actualizarTabla() {
    // Obtener la referencia a la tabla
    let tabla = document.getElementById("tabla-servicios");
    // Limpiar la tabla
    tabla.innerHTML = "";
    let tableContainer = document.getElementById("table-container");
    let totalContainer = document.getElementById("total-container");
    let button = document.getElementById("button");
    let inputTotal = document.getElementById("total");
    if (serviciosAgregados.length >= 1) {
        tableContainer.classList.remove("d-none");
        totalContainer.classList.remove("d-none");
        button.classList.remove("d-none");
    } else {
        tableContainer.classList.add("d-none");
        totalContainer.classList.add("d-none");
        button.classList.add("d-none");
        inputTotal.classList.add("d-none");
        return;
    }

    // Agregar los encabezados de la tabla
    let header = tabla.createTHead();
    let row = header.insertRow(0);
    let th1 = document.createElement("th");
    let th2 = document.createElement("th");
    let th3 = document.createElement("th");
    let th4 = document.createElement("th");
    let th5 = document.createElement("th");
    let th6 = document.createElement("th");
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



    let total = 0;

    // Crear una nueva fila para cada servicio agregado y agregarla a la tabla
    for (let i = 0; i < serviciosAgregados.length; i++) {
        let servicio = serviciosAgregados[i];
        let fila = tabla.insertRow();
        let celdaNo = fila.insertCell(0);
        let celdaNombre = fila.insertCell(1);
        let celdaCosto = fila.insertCell(2);
        let celdaCantidad = fila.insertCell(3);
        let celdaTotal = fila.insertCell(4);
        let celdaEliminar = fila.insertCell(5); // Agregar celda para botón de eliminar
        let celdaCheckbox = fila.insertCell(6);

        celdaNo.innerHTML = i + 1;
        celdaNombre.innerHTML = servicio.name;
        celdaCosto.innerHTML = servicio.cost;
        celdaCantidad.innerHTML = servicio.cant;

        total += servicio.total;

        // Agregar botón de eliminar y su funcionalidad
        let btnEliminar = document.createElement("button");
        btnEliminar.innerHTML = "ELIMINAR";
        btnEliminar.dataset.index = i;
        btnEliminar.classList.add("btn", "btn-danger", "btn-sm");
        btnEliminar.addEventListener("click", function() {
            let index = this.dataset.index;
            serviciosAgregados.splice(index, 1);
            total -= servicio.total;
            actualizarTabla();
        });
        celdaEliminar.appendChild(btnEliminar);

        if (servicio.partial == 0) {
            let miTagP = document.getElementById('labelPartial');
            let cadena = 'Selecciona la casilla de Pago parcial si quieres que el servicio sea pagado a cuotas.<br>' +
                'Valor del servicio: $' + servicio.total + '<br>' +
                'Servicio a 5 cuotas de: $' + (servicio.total / 5);
            miTagP.innerHTML = cadena;
            let th7 = document.createElement("th");
            th7.innerHTML = "PAGOS PARCIALES";
            row.appendChild(th7);
            celdaTotal.innerHTML = (servicio.total);
            let checkboxPartial = document.createElement("input");
            checkboxPartial.type = 'checkbox';
            checkboxPartial.dataset.index = i;
            checkboxPartial.name = "payment_partial";
            checkboxPartial.addEventListener("click", function() {
                if (checkboxPartial.checked == true) {
                    let index = this.dataset.index;
                    console.log(serviciosAgregados[index]);
                    document.getElementById("total").value = (total / 5);
                    celdaTotal.innerHTML = (servicio.total / 5);
                } else {
                    document.getElementById("total").value = total;
                    celdaTotal.innerHTML = servicio.total;
                }
            });
            celdaCheckbox.appendChild(checkboxPartial);
            document.getElementById("total").value = total;
        } else {
            celdaTotal.innerHTML = servicio.total;
            document.getElementById("total").value = total;
        }
    }
}

function arrayData() {
    myForm.addEventListener("submit", function(evt) {
        evt.preventDefault();
        window.history.back();
    }, true);

    document.getElementById("total").disabled = false;

    // después de agregar un servicio a `serviciosAgregados`
    document.getElementById('serviciosAgregadosInput').value = JSON.stringify(serviciosAgregados);

}


function eliminarServicio(indice) {
    serviciosAgregados.splice(indice, 1);
    actualizarTabla();
}