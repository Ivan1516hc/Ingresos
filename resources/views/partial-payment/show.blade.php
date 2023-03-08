@extends('layouts.app')

@section('template_title')
    {{ $partialPayment->name ?? 'Show Partial Payment' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Partial Payment</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('partial-payments.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Beneficiary Id:</strong>
                            {{ $partialPayment->beneficiary_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiary Name:</strong>
                            {{ $partialPayment->beneficiary_name }}
                        </div>
                        <div class="form-group">
                            <strong>Service Id:</strong>
                            {{ $partialPayment->service_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $partialPayment->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Payment:</strong>
                            {{ $partialPayment->payment }}
                        </div>
                        <div class="form-group">
                            <strong>Partiality:</strong>
                            {{ $partialPayment->partiality }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $partialPayment->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
