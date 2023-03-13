@extends('layouts.app')

@section('template_title')
    {{ $transaction->name ?? 'Show Transaction' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">INFORMACÓN DE MOVIMIENTO</span>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('transactions.index') }}">REGRESAR</a>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="float-right">
                            <a class="btn btn-lg btn-success" onclick="showModal()">Reimprimir</a>
                        </div>
                        <div class="form-group">
                            <strong>Folio:</strong>
                            {{ $transaction->invoice }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            $ {{ $transaction->total }}
                        </div>
                        <div class="form-group">
                            <strong>Id Beneficiario:</strong>
                            {{ $transaction->beneficiary_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Beneficiario:</strong>
                            {{ $transaction->beneficiary_name }}
                        </div>
                        <div class="form-group">
                            <strong>Centro:</strong>
                            {{ $transaction->location->name }}
                        </div>
                        <div class="form-group">
                            <strong>Cajero:</strong>
                            {{ $transaction->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $transaction->status == 1 ? 'ACTIVO' : 'PENDIENTE' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div class="modal fade centerModal" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">Reimpresión</p>
            </div>
            <!--Body-->
            <div class="modal-body row">
                <label for="recipient-name" class="col-form-label">Deseas reimprir el ticket con folio <strong>{{$transaction->invoice}} </strong>
                que fue creado el día <strong>{{$transaction->created_at->format('d-m-Y')}}</strong>, al beneficiario <strong>{{$transaction->beneficiary_name}}</strong></label>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <a type="button"  onclick="reimprimir({{$transaction->invoice}})" class="btn btn-primary">Reimprimir</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

<script src="../../js/reprint.js"></script>
