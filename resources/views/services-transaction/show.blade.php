@extends('layouts.app')

@section('template_title')
    {{ $servicesTransaction->name ?? 'Show Services Transaction' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Services Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services-transactions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Transaction Id:</strong>
                            {{ $servicesTransaction->transaction_id }}
                        </div>
                        <div class="form-group">
                            <strong>Service Id:</strong>
                            {{ $servicesTransaction->service_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
