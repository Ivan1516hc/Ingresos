@extends('layouts.template')

<script src="./js/cards.js"></script>

@section('content')
    <!--Content Start-->
    <div class="content transition">
        <div class="container-fluid dashboard">
            <h3>INGRESOS</h3>
            <div class="row">
                @for ($i = 0; $i < count($cards); $i++)
                    {!! $cards[$i] !!}
                @endfor
            </div>
        </div>
    </div>
@endsection
            <div class="collapse" id="collapseCaja">
                <hr>
                <h4>OPCIONES DE CAJA</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a href="/" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-wallet icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>COBROS</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="/movimientos" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-history icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>HISTORIAL</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>

            <div class="collapse" id="collapseCatalogos">
                <hr>
                <h4>OPCIONES DE CATÁLOGOS</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a href="/servicios" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-chalkboard-teacher icon-home bg-success text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>SERVICIÓS</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="/ubicaciones" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-map-marked icon-home bg-success text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>UBICACIONES</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="/promotores" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-user-tie icon-home bg-success text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>PROMOTORES</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="/terapeutas" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-user-nurse icon-home bg-success text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>TERAPEUTAS</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="/usuarios" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="fas fa-users icon-home bg-success text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>USUARIOS</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="collapse" id="collapseReportes">
                <hr>
                <h4>OPCIONES DE REPORTES</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-info text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>REPORTE POR FECHAS</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-info text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>REEPORTE POR CENTRO</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-info text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>REPORTE DE PARCIALIDADES</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="collapse" id="collapseAdministracion">
                <hr>
                <h4>OPCIONES DE ADMINISTRACIÓN</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-warning text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CANCELACION PAGOS PARCIALES</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-warning text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CANCELACION RF</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
