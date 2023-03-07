window.addEventListener('DOMContentLoaded', () => {
});
function abonar(id) {
    axios.get('http://127.0.0.1:8000/partial/' + id)
        .then(response => {
            window.location.href = response.data;
        })
        .catch(error => {
            console.error(error);
        })
}

function modal(data) {
    let miTagP = document.getElementById('text');
    miTagP.innerHTML = '';
    abono.addEventListener('click', function () {
        abonar(data.id);
    });
    let cadena = 'Generar abono del servicio <strong>' + data.service.name + '</strong>, el servicio fue adquirido a 5 parcialidades. El servicio tiene un valor de <strong>$' + data.service.cost + '</strong> y actualmente se a abonado <strong>$' + data.payment + '</strong><br> <br>' + 'El abono sera de <strong>$' + (data.service.cost / 5) + '</strong>';
    miTagP.innerHTML = cadena;
    let modal = document.getElementById('modalPagosParciales');
    let openModal = new bootstrap.Modal(modal);
    return openModal.show();
}

function cancel(id) {
    axios.get('http://127.0.0.1:8000/partial/cancel/' + id)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}