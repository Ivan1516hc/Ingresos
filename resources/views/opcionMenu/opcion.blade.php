@extends('layouts.template')
@section('content')
    <!--Content Start-->
    <div class="content transition">
        <div class="container-fluid dashboard">
            <h3>INGRESOS</h3>
            <div class="row">
            <div class="col-md-6 col-lg-3">
                <a href="users" class="card">
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
                <a href="transactions" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="las fa-list-ul icon-home bg-success text-light"></i>
                            </div>
                            <div class="col-9 offset-1">
                                <h5 >CATÁLOGO</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="index.html" class="card">
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
                <a href="index.html" class="card">
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
    </div>
@endsection