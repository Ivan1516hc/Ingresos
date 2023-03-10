window.addEventListener('DOMContentLoaded', () => {
    generateCards();
});

function myCollapse(target) {
    let card = '';
    const obj = target.id;
    const profile_id = window.profile_id;
    let cardData = {
        caja: {
            cobros: {
                profile_id: [3],
                links: '/movimientos/create',
                iconClass: 'fas fa-wallet',
                iconColor: 'bg-primary text-light',
                title: 'COBROS'
            },
            historial: {
                profile_id: [1, 2, 3],
                links: '/movimientos',
                iconClass: 'fas fa-history',
                iconColor: 'bg-primary text-light',
                title: 'HISTORIAL'
            },
            pagos_parciales: {
                profile_id: [2, 1, 3],
                links: '/pagos-parciales',
                iconClass: 'las la-history',
                iconColor: 'bg-primary text-light',
                title: ' PAGOS PARCIALES'
            }
        },
        catalogos: {
            servicios: {
                profile_id: [1, 2, 3],
                links: '/servicios',
                iconClass: 'fas fa-chalkboard-teacher',
                iconColor: 'bg-success text-light',
                title: 'SERVICIOS'
            },
            ubicaciones: {
                profile_id: [2, 1],
                links: '/ubicaciones',
                iconClass: 'fas fa-map-marked',
                iconColor: 'bg-success text-light',
                title: 'UBICACIONES'
            },
            promotores: {
                profile_id: [1, 2, 3],
                links: '/promotores',
                iconClass: 'fas fa-user-tie',
                iconColor: 'bg-success text-light',
                title: 'PROMOTORES'
            },
            terapeutas: {
                profile_id: [1, 2, 3],
                links: '/terapeutas',
                iconClass: 'fas fa-user-nurse',
                iconColor: 'bg-success text-light',
                title: 'TERAPEUTAS'
            },
            usuarios: {
                profile_id: [1],
                links: '/usuarios',
                iconClass: 'fas fa-users',
                iconColor: 'bg-success text-light',
                title: 'USUARIOS'
            },
            grupos: {
                profile_id: [1, 2],
                links: '/grupos',
                iconClass: 'fas fa-users',
                iconColor: 'bg-success text-light',
                title: 'GRUPOS'
            }
        },
        reportes: {
            reporteFechas: {
                profile_id: [1, 2, 3],
                links: '/',
                iconClass: 'fas fa-calendar-alt',
                iconColor: 'bg-info text-light',
                title: 'REPORTE POR FECHA'
            },
            reporteCentro: {
                profile_id: [1, 2, 3, 4],
                links: '/',
                iconClass: 'fas fa-file-invoice',
                iconColor: 'bg-info text-light',
                title: 'REPORTE POR CENTRO'
            },
            reporteParcialidades: {
                profile_id: [1, 2],
                links: '/',
                iconClass: 'fas fa-newspaper',
                iconColor: 'bg-info text-light',
                title: 'REPORTE PARCIALIDADES'
            }
        },
        administracion: {
            cancelacionRF: {
                profile_id: [1, 2, 5],
                links: '/cancelaciones',
                iconClass: 'fas fa-times-circle',
                iconColor: 'bg-warning text-light',
                title: 'CANCELACIONES'
            },
            historialC: {
                profile_id: [1, 2, 5],
                links: '/historial-cancelacion',
                iconClass: 'fas fa-times-circle',
                iconColor: 'bg-warning text-light',
                title: 'HISTORIAL CANCELACION'
            },
            historialR: {
                profile_id: [1, 2, 5],
                links: '/historial-reimpresion',
                iconClass: 'fas fa-times-circle',
                iconColor: 'bg-warning text-light',
                title: 'HISTORIAL REIMPRECIÓN'
            }
        }
    }
    card += '<h4 class="text-uppercase">OPCIONES ' + obj + '</h4>';
    card += '<hr>';
    card += '<div class="row">';

    Object.keys(cardData).forEach((tag) => {
        if (tag != obj)
            document.getElementById(tag).classList.remove("show");
    });
    // Iteramos a través de los elementos de cardData['caja']
    Object.values(cardData[obj]).forEach((element) => {
        // Verificamos si el elemento tiene un valor de profile_id que coincida con el valor que queremos mostrar
        if (element.profile_id.includes(profile_id)) {
            card += '<div class="col-md-6 col-lg-3">';
            card += '<a href="' + element.links + '" class="card">';
            card += '<div class="card-body">';
            card += '<div class="row">';
            card += '<div class="col-2 d-flex align-items-center">';
            card += '<i class="' + element.iconClass + ' icon-home ' + element.iconColor + '"></i>';
            card += '</div>';
            card += '<div class="col-9 offset-1">';
            card += '<h5>' + element.title + '</h5>';
            card += '</div>';
            card += '</div>';
            card += '</div>';
            card += '</a>';
            card += '</div>';
        }
    });
    card += '</div>';
    target.innerHTML = card;
}

function generateCards() {
    let card = '';
    const profile_id = window.profile_id;
    let cardData = [
        {
            target: 'caja',
            iconClass: 'fas fa-inbox',
            iconColor: 'bg-primary text-light',
            title: 'CAJA',
            profile_id: [2, 3, 1] // Tarjeta de Caja visible para perfiles 1 y 2
        }, {
            target: 'catalogos',
            iconClass: 'fas fa-list-ul',
            iconColor: 'bg-success text-light',
            title: 'CATÁLOGOS',
            profile_id: [1, 2, 3] // Tarjeta de Catálogos visible para perfiles 1 y 2
        }, {
            target: 'reportes',
            iconClass: 'las la-clipboard-list',
            iconColor: 'bg-info text-light',
            title: 'REPORTES',
            profile_id: [1, 2, 3, 4] // Tarjeta de Reportes visible solo para perfil 2
        }, {
            target: 'administracion',
            iconClass: 'fas fa-file-archive',
            iconColor: 'bg-warning text-light',
            title: 'ADMINISTRACIÓN',
            profile_id: [1, 2, 5] // Tarjeta de Administración visible solo para perfil 1
        }];

    for (var i = 0; i < cardData.length; i++) {
        if (cardData[i].profile_id.includes(profile_id)) {
            card += '<div class="col-md-6 col-lg-3">';
            card += '<a onclick="myCollapse(' + cardData[i].target + ')" data-toggle="collapse" data-target="#' + cardData[i].target;
            card += '" aria-expanded="false" aria-controls="' + cardData[i].target + '" class="card" type="button">';
            card += '<div class="card-body">';
            card += '<div class="row">';
            card += '<div class="col-2 d-flex align-items-center">';
            card += '<i class="' + cardData[i].iconClass + ' icon-home ' + cardData[i].iconColor + '"></i>';
            card += '</div>';
            card += '<div class="col-9 offset-1">';
            card += '<h5>' + cardData[i].title + '</h5>';
            card += '</div>';
            card += '</div>';
            card += '</div>';
            card += '</a>';
            card += '</div>';
        }
    }
    cardsDiv.innerHTML = card;
}