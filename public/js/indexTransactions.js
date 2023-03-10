window.addEventListener('DOMContentLoaded', () => {

});
var data = '';
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

// $('#btnCancel').on('click', function () {
//     return alert('hola');
//     if (reason.value == '') {
//         return alert('Necesitas poner una razón de cancelacion');
//     }
//     data['reason'] = reason.value;
//     sendRequestCancel(data);
// });
btn = document.getElementById('btnCancel');
btn.addEventListener('click', function () {
    if (reason.value == '') {
        return alert('Necesitas poner una razón de cancelacion');
    }
    data['reason'] = reason.value;
    console.log(data.reason)
    sendRequestCancel(data);
})