window.addEventListener('DOMContentLoaded', () => {
    getServices();

});
let serviciosAgregados = [];


let acciones = {
    "clave1": "#mm",
    "clave2": "#mf",
    "clave3": "#am",
    "clave4": "#af",
    "clave5": "#amm",
    "clave6": "#amf"
};

$(".checkbox-accion").change(function () {
    // Obtiene el valor del atributo 'data-clave' del checkbox que se cambió
    let clave = $(this).data("clave");
    // Verifica si el checkbox está activado o no
    let activado = this.checked;
    // Utiliza el método 'prop' de jQuery para habilitar o deshabilitar el elemento correspondiente
    $(acciones[clave]).prop("disabled", !activado);
});




function noBildingCheckbox(checkbox) {
    let inputName = document.getElementById("beneficiary_name");
    let inputId = document.getElementById("beneficiary_id");
    if (checkbox.checked) {
        inputName.disabled = true;
        inputId.value = 'DIFZAP2019026294';
        inputId.disabled = true;
        inputName.value = 'NO VINCULANTE NO VINCULANTE NO VINCULANTE';
        serviciosAgregados = []
        getServicesNotBulding();
        actualizarTabla();
    } else {
        inputName.disabled = false;
        inputId.disabled = false;
        inputId.value = '';
        inputName.value = '';
        document.getElementById("table-container").innerHTML = "";
        serviciosAgregados = []
        getServicesNotBulding();
        getServices();
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
            document.getElementById("services").innerHTML = "";
            let select = document.getElementById("services");
            let el = document.createElement("option");
            el.textContent = 'SELECCIONA SERVICIO';
            select.add(el);
            for (let i = 0; i < response.data.length; i++) {
                let opt = response.data[i];
                let el = document.createElement("option");
                el.textContent = opt.name;
                el.value = JSON.stringify({ id: opt.id, name: opt.name, cost: opt.cost, not_binding: opt.not_binding, partial: opt.partial, cant: '' });
                select.add(el);
            }
        })
        .catch(error => console.error(error))
}

function getTherapists() {
    axios.get('http://127.0.0.1:8000/gettherapists')
        .then(response => {
            document.getElementById("therapists").innerHTML = "";
            let select = document.getElementById("therapists");
            let el = document.createElement("option");
            el.textContent = '--Selecciona Terapeuta--';
            select.add(el);
            for (let i = 0; i < response.data.length; i++) {
                let opt = response.data[i];
                let el = document.createElement("option");
                el.textContent = opt.name;
                el.value = opt.id;
                select.add(el);
            }
        })
        .catch(error => console.error(error))
}

function getPromoters() {
    axios.get('http://127.0.0.1:8000/getpromoters')
        .then(response => {
            document.getElementById("promoters").innerHTML = "";
            let select = document.getElementById("promoters");
            let el = document.createElement("option");
            el.textContent = '--Selecciona Promotor--';
            select.add(el);
            for (let i = 0; i < response.data.length; i++) {
                let opt = response.data[i];
                let el = document.createElement("option");
                el.textContent = opt.name;
                el.value = opt.id;
                select.add(el);
            }
        })
        .catch(error => console.error(error))
}

function getServicesNotBulding() {
    axios.get('http://127.0.0.1:8000/servicios-no-vinculantes')
        .then(response => {
            document.getElementById("services").innerHTML = "";
            let select = document.getElementById("services");
            let el = document.createElement("option");
            el.textContent = 'SELECCIONA SERVICIO';
            select.add(el);
            for (let i = 0; i < response.data.length; i++) {
                let opt = response.data[i];
                let el = document.createElement("option");
                el.textContent = opt.name;
                el.value = JSON.stringify({ id: opt.id, name: opt.name, cost: opt.cost, not_binding: opt.not_binding, partial: opt.partial, cant: '' });
                select.add(el);
            }
        })
        .catch(error => console.error(error))
}

var partialPayment = false;

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
    if (serviciosAgregados.length >= 1 && servicio.partial !== serviciosAgregados[0].partial || partialPayment) {
        let modal = document.getElementById('exampleModal');
        let openModal = new bootstrap.Modal(modal);
        return openModal.show();
    }
    let idsServicios = serviciosAgregados.map(servicio => servicio.id);
    let serviciosCuotas = [69, 70, 71, 84, 85];
    let serviciosCuotasAgregados = serviciosCuotas.filter(id => idsServicios.includes(id));

    
    if (serviciosCuotasAgregados.length >= 1) {
        alert('No se pueden agregar más servicios a cuotas');
        return;
    }
    if (serviciosAgregados.some(s => serviciosCuotas.includes(s.id))) {
        alert('Ya existe un servicio a cuotas agregado');
        return;
    }    
    if (serviciosAgregados.some(s => s.id === servicio.id)) {
        alert('El servicio ya ha sido agregado');
        return;
    }
    if (serviciosAgregados.length >= 1 && serviciosCuotas.includes(servicio.id)) {
        alert('No se pueden agregar un servicio a cuotas con servicios normales');
        return;
    }

    // Agregar el servicio a la letiable global
    serviciosAgregados.push(servicio);
    partialPayment = serviciosAgregados[0].partial ? true : false;
    if (partialPayment) {
        labelPartial.classList.remove("d-none");
    }
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
    let label = document.getElementById('labelPartial');

    if (serviciosAgregados.length >= 1) {
        tableContainer.classList.remove("d-none");
        totalContainer.classList.remove("d-none");
        button.classList.remove("d-none");
        inputTotal.classList.remove("d-none");
    } else {
        tableContainer.classList.add("d-none");
        totalContainer.classList.add("d-none");
        button.classList.add("d-none");
        inputTotal.classList.add("d-none");
        label.classList.add("d-none");
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
        btnEliminar.addEventListener("click", function () {
            let index = this.dataset.index;
            serviciosAgregados.splice(index, 1);
            total -= servicio.total;
            partialPayment = false;
            actualizarTabla();
        });
        celdaEliminar.appendChild(btnEliminar);

        if (servicio.partial == 5) {
            let cost = servicio.cost;
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
            checkboxPartial.addEventListener("click", function () {
                if (checkboxPartial.checked == true) {
                    let index = this.dataset.index;
                    serviciosAgregados[index].total = (servicio.total / 5);
                    serviciosAgregados[index].cost = (cost / 5);
                    console.log(serviciosAgregados[index]);
                    document.getElementById("total").value = (total / 5);
                    celdaTotal.innerHTML = (total / 5);
                    celdaCosto.innerHTML = (servicio.cost);
                } else {
                    let index = this.dataset.index;
                    serviciosAgregados[index].total = total;
                    serviciosAgregados[index].cost = cost;
                    console.log(serviciosAgregados[index]);
                    celdaCosto.innerHTML = cost;
                    document.getElementById("total").value = total;
                    celdaTotal.innerHTML = total;
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

function psicologo() {
    let idsServicios = serviciosAgregados.map(servicio => servicio.id);
    let nbServices = serviciosAgregados.map(servicio => servicio.id);

    let serviciosNB = serviciosAgregados.filter(servicio => servicio.not_binding == 1);
    let serviciosNBAgregados = serviciosNB.filter(servicio => nbServices.includes(servicio.id));

    let serviciosPsicologicos = [66, 75, 76, 77, 78, 88, 155, 156, 157, 158];
    let serviciosPsicologicosAgregados = serviciosPsicologicos.filter(id => idsServicios.includes(id));

    let serviciosCuotas = [69, 70, 71, 84, 85];
    let serviciosCuotasAgregados = serviciosCuotas.filter(id => idsServicios.includes(id));

    let serviciosPromotores = [184, 185, 186, 187, 188];
    let serviciosPromotoresAgregados = serviciosPromotores.filter(id => idsServicios.includes(id));

    if (serviciosNBAgregados.length > 0) {
        let modal = document.getElementById('modalNB');
        let openModal = new bootstrap.Modal(modal);
        return openModal.show();
    }
    if (serviciosPsicologicosAgregados.length > 0) {
        let modal = document.getElementById('modalTherapists');
        let openModal = new bootstrap.Modal(modal);
        therapists.setAttribute('required', true);
        getTherapists();
        return openModal.show();
    }
    if (serviciosPromotoresAgregados.length > 0) {
        let modal = document.getElementById('modalPromotores');
        let openModal = new bootstrap.Modal(modal);
        promoters.setAttribute('required', true);
        getPromoters();
        return openModal.show();
    }
    if (serviciosCuotasAgregados.length > 0) {
        let modal = document.getElementById('modalCuotas');
        let openModal = new bootstrap.Modal(modal);
        bill.value = beneficiary_name.value;
        bill.disabled = false;
        bill.setAttribute('required', true);
        cuota.disabled = false;
        cuota.setAttribute('required', true);
        return openModal.show();
    }
    if (serviciosPsicologicosAgregados == 0 && serviciosCuotasAgregados.length == 0 && serviciosPromotoresAgregados.length == 0 && serviciosNBAgregados.length == 0) {
        submit();
    }
}

$('#btn-generar-movimiento').on('click', function () {
    // Verificar si al menos un input tiene un valor y no está deshabilitado
    let inputs = $('.elemento');
    let tieneValor = false;
    for (let i = 0; i < inputs.length; i++) {
        if ($(inputs[i]).val() !== '' && !$(inputs[i]).is(':disabled')) {
            tieneValor = true;
            break;
        }
    }
    if (tieneValor) {
        submit();
    } else {
        alert('Por favor ingrese al menos un valor en un campo habilitado');
    }
});

$('#modalPromotores').on('hidden.bs.modal', function (e) {
    promoters.removeAttribute('required');
    promoters.innerHTML = "";
})

$('#modalTherapists').on('hidden.bs.modal', function (e) {
    therapists.removeAttribute('required');
    therapists.innerHTML = "";
})

$('#modalNB').on('hidden.bs.modal', function (e) {
    mm.disabled = true;
    mf.disabled = true;
    am.disabled = true;
    af.disabled = true;
    amm.disabled = true;
    amf.disabled = true;
})

$('#modalCuotas').on('hidden.bs.modal', function (e) {
    bill.removeAttribute('required');
    bill.disabled = true;
    cuota.removeAttribute('required');
    cuota.disabled = true;
})

var cancelBtnNB = document.querySelector('#modalNB [data-dismiss="modal"]');
cancelBtnNB.addEventListener('click', function () {
    mm.disabled = true;
    mf.disabled = true;
    am.disabled = true;
    af.disabled = true;
    amm.disabled = true;
    amf.disabled = true;
});

var cancelBtnPromoters = document.querySelector('#modalPromotores [data-dismiss="modal"]');
cancelBtnPromoters.addEventListener('click', function () {
    promoters.removeAttribute('required');
    promoters.innerHTML = "";
});

var cancelBtnTherapists = document.querySelector('#modalTherapists [data-dismiss="modal"]');
cancelBtnTherapists.addEventListener('click', function () {
    therapists.removeAttribute('required');
    therapists.innerHTML = "";
});

var cancelBtnCuotas = document.querySelector('#modalCuotas [data-dismiss="modal"]');
cancelBtnCuotas.addEventListener('click', function () {
    bill.removeAttribute('required');
    bill.disabled = true;
    cuota.removeAttribute('required');
    cuota.disabled = true;
});

function submit() {
    document.getElementById("beneficiary_id").disabled = false;
    document.getElementById("beneficiary_name").disabled = false;
    // después de agregar un servicio a `serviciosAgregados`
    document.getElementById('serviciosAgregadosInput').value = JSON.stringify(serviciosAgregados);
    myForm.submit();
}

function arrayData() {
    psicologo();
}

$('#btn-generar-movimiento-therapists').on('click', function () {
    if ($('#therapists').length) {
        if ($('#therapists').val() == '--Selecciona Terapeuta--') {
            return alert('Elige un terapeuta');
        }
    }
    submit();
});
$('#btn-generar-movimiento-cuota').on('click', function () {
    submit();
});

$('#btn-generar-movimiento-promoters').on('click', function () {
    if ($('#promoters').length) {
        if ($('#promoters').val() == '--Selecciona Promotor--') {
            return alert('Elige un promotor');
        }
    }
    submit();
});

// Gets a reference to the form element
var form = document.getElementById('myForm');
// Adds a listener for the "submit" event.
form.addEventListener('submit', function (e) {
    e.preventDefault();
});