window.addEventListener('DOMContentLoaded', () => {

});

function cancelJD(id) {
    axios.get('http://127.0.0.1:8000/mov/' + id)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}

function cancelRF(id) {
    axios.get('http://127.0.0.1:8000/mov/request-cancel/' + id)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}