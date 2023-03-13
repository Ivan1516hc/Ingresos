function showModal() {
    let modal = document.getElementById('showModal');
    let openModal = new bootstrap.Modal(modal);
    return openModal.show();
}

function reimprimir(invoice){
    console.log(invoice);
    axios.post('http://127.0.0.1:8000/reprint', {invoice})
    .then(response => {
        window.location="/ticket/"+invoice;
    })
    .catch(error => {
        console.error(error);
    })
}