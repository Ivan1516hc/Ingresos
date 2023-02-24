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
                el.value = JSON.stringify({ id: opt.id, name: opt.name, cost: opt.cost, opt: opt.not_binding, partial: opt.partial, cant: '' });
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
                el.value = JSON.stringify({ id: opt.id, name: opt.name, cost: opt.cost, opt: opt.not_binding, partial: opt.partial, cant: '' });
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
                    document.getElementById("total").value = (total / 5);
                    celdaTotal.innerHTML = servicio.total;
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

function psicologo() {
    const idsServicios = serviciosAgregados.map(servicio => servicio.id);
    
    const serviciosPsicologicos = [66, 75, 76, 77, 78, 88, 155, 156, 157, 158];
    const serviciosPsicologicosAgregados = serviciosPsicologicos.filter(id => idsServicios.includes(id));
    console.log(serviciosPsicologicosAgregados);
    if (serviciosPsicologicosAgregados.length > 0) {
      const select = document.createElement('select');
      select.name = 'terapeutas';
      select.id = 'terapeutas';
  
      const therapints = ['Terapeuta 1', 'Terapeuta 2', 'Terapeuta 3', 'Terapeuta 4'];
      for (const terapeuta of therapints) {
        const option = document.createElement('option');
        option.value = terapeuta;
        option.text = terapeuta;
        select.appendChild(option);
      }
  
      const modal = document.createElement('div');
      modal.classList.add('modal');
      modal.innerHTML = `
        <div class="modal-content">
          <h2>Terapeutas disponibles</h2>
          <p>Por favor, seleccione un terapeuta:</p>
          ${select.outerHTML}
          <button onclick="cerrarModal()">Cerrar</button>
        </div>
      `;
      document.body.appendChild(modal);
    }
  }

function promotor() {

}

function cuota() {

}

function arrayData() {
    
    myForm.addEventListener("submit", function (evt) {
        evt.preventDefault();
        window.history.back();
        
    }, true);
    psicologo();
    confirm('Aceptar');
    document.getElementById("beneficiary_id").disabled = false;
    document.getElementById("beneficiary_name").disabled = false;

    // después de agregar un servicio a `serviciosAgregados`
    document.getElementById('serviciosAgregadosInput').value = JSON.stringify(serviciosAgregados);

}