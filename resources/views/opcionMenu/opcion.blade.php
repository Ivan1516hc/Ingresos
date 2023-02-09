@extends('layouts.template')

@section('content')
    <!--Content Start-->
    <div class="content transition">
        <div class="container-fluid dashboard">
            <h3>INGRESOS</h3>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <a data-toggle="collapse" data-target="#collapseCaja" aria-expanded="false" aria-controls="collapseCaja"
                        class="card" type="button">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <i class="las la-inbox icon-home bg-primary text-light"></i>
                                </div>
                                <div class="col-9 offset-1">
                                    <h5>CAJA</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a data-toggle="collapse" data-target="#collapseCatalogos" aria-expanded="false"
                        aria-controls="collapseCatalogo" class="card" type="button">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <i class="las fa-list-ul icon-home bg-success text-light"></i>
                                </div>
                                <div class="col-9 offset-1">
                                    <h5>CATÁLOGOS</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false"
                        aria-controls="collapseReportes" class="card" type="button">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <i class="las la-clipboard-list  icon-home bg-info text-light"></i>
                                </div>
                                <div class="col-9 offset-1">
                                    <h5>REPORTES</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a data-toggle="collapse" data-target="#collapseAdministracion" aria-expanded="false"
                        aria-controls="collapseAdministracion" class="card" type="button">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 d-flex align-items-center">
                                    <i class="las fa-file-archive  icon-home bg-warning text-light"></i>
                                </div>
                                <div class="col-9 offset-1">
                                    <h5>ADMINISTRACIÓN</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="collapse" id="collapseCaja">
                <hr>
                <h4>OPCIONES DE CAJA</h1>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CAJA</h5>
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
                            <a class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2 d-flex align-items-center">
                                            <i class="las la-inbox icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CAJA</h5>
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
                                            <i class="las la-inbox icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CAJA</h5>
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
                                            <i class="las la-inbox icon-home bg-primary text-light"></i>
                                        </div>
                                        <div class="col-9 offset-1">
                                            <h5>CAJA</h5>
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
@endsection
