function generateCards() {
    var cards = [];
    var cardData = [{
        target: 'collapseCaja',
        iconClass: 'fas fa-inbox',
        iconColor: 'bg-primary text-light',
        title: 'CAJA'
    }, {
        target: 'collapseCatalogos',
        iconClass: 'fas fa-list-ul',
        iconColor: 'bg-success text-light',
        title: 'CATÁLOGOS'
    }, {
        target: 'collapseReportes',
        iconClass: 'las la-clipboard-list',
        iconColor: 'bg-info text-light',
        title: 'REPORTES'
    }, {
        target: 'collapseAdministracion',
        iconClass: 'fas fa-file-archive',
        iconColor: 'bg-warning text-light',
        title: 'ADMINISTRACIÓN'
    }];

    for (var i = 0; i < cardData.length; i++) {
        var card =
            '<div class="col-md-6 col-lg-3">' +
            '<a data-toggle="collapse" data-target="#' + cardData[i].target +
            '" aria-expanded="false" aria-controls="' + cardData[i].target + '" class="card" type="button">' +
            '<div class="card-body">' +
            '<div class="row">' +
            '<div class="col-2 d-flex align-items-center">' +
            '<i class="' + cardData[i].iconClass + ' icon-home ' + cardData[i].iconColor + '"></i>' +
            '</div>' +
            '<div class="col-9 offset-1">' +
            '<h5>' + cardData[i].title + '</h5>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</a>' +
            '</div>';
        cards.push(card);
    }
    return cards;
}
