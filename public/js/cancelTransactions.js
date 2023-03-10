window.addEventListener('DOMContentLoaded', () => {

});

function cancelJD(invoice) {
    console.log(invoice);
    axios.post('http://127.0.0.1:8000/mov/', invoice)
        .then(response => {
            location.reload();
        })
        .catch(error => {
            console.error(error);
        })
}