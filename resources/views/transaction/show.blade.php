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
                            <span class="card-title">Show Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('transactions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Invoice:</strong>
                            {{ $transaction->invoice }}
                        </div>
                        <div class="form-group">
                            <strong>Bill:</strong>
                            {{ $transaction->bill }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $transaction->total }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiary Id:</strong>
                            {{ $transaction->beneficiary_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiary Name:</strong>
                            {{ $transaction->beneficiary_name }}
                        </div>
                        <div class="form-group">
                            <strong>Location Id:</strong>
                            {{ $transaction->location_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $transaction->user_id }}
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
