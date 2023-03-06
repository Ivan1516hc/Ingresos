window.addEventListener('DOMContentLoaded', () => {

});

function modal() {
    let modal = document.getElementById('modalPagosParciales');
    let openModal = new bootstrap.Modal(modal);
    return openModal.show();
}

function abonar(id) {
    axios.get('http://127.0.0.1:8000/partial/' + id)
        .then(response => {
            window.location.href = response.data;
        })
        .catch(error => {
            console.error(error);
        })
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