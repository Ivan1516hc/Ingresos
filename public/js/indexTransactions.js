window.addEventListener('DOMContentLoaded', () => {
    let acciones = {
        "transactions:invoice": "#invoice",
        "transactions:benefiriary_id": "#benefiriary_id",
        "transactions:beneficiary_name": "#beneficiary_name",
        "transactions:status": "#status",
        "transactions:created_at": "#created_at",
        "TODOS": ".accion",
    };

    document.getElementById("selectAccion").addEventListener("change", function () {
        let clave = this.value;
        opcion = this.value;
        if (clave === "TODOS") {
            document.querySelectorAll(acciones[clave]).forEach(function (el) {
                el.classList.add("d-none");
            });
        } else {
            document.querySelectorAll(acciones[clave]).forEach(function (el) {
                el.classList.remove("d-none");
            });

            document.querySelectorAll(acciones["TODOS"]).forEach(function (el) {
                if (clave === "transactions:invoice" || clave === "transactions:benefiriary_id" || clave === "transactions:beneficiary_name" || clave === "transactions:status" || clave === "transactions:created_at") {
                    if (el.id !== acciones[clave].substring(1)) {
                        el.classList.add("d-none");
                    }
                } else {
                    el.classList.remove("d-none");
                }
            });
        }
    });
});
var data = '';
var opcion = '';
var search = '';
function modal(transaction) {
    data = transaction;
    let modal = document.getElementById('modalCancel');
    let openModal = new bootstrap.Modal(modal);
    return openModal.show();
}

function cancelar(data) {
    axios.post('http://127.0.0.1:8000/mov', data)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}

function sendRequestCancel(data) {
    axios.post('http://127.0.0.1:8000/mov/request-cancel', data)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}

btn = document.getElementById('btnCancel');
btn.addEventListener('click', function () {
    if (reason.value == '') {
        return alert('Necesitas poner una razón de cancelacion');
    }
    data['reason'] = reason.value;
    console.log(data.reason)
    sendRequestCancel(data);
})

function changed(e) {
    opcion = e.target.value;
    console.log(opcion);
}


