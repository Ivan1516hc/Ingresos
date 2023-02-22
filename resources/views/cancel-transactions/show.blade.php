@extends('layouts.app')

@section('template_title')
    {{ $transaction->name ?? 'Show Transaction' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">INFORMACÓN DE MOVIMIENTO</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cancel-transactions.index') }}">REGRESAR</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Folio:</strong>
                            {{ $transaction->invoice }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $transaction->total }}
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
                            {{ $transaction->status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
