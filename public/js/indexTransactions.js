window.addEventListener('DOMContentLoaded', () => {

});

function modal() {
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

function sendRequestCancel(id) {
    axios.get('http://127.0.0.1:8000/mov/request-cancel/' + id)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}