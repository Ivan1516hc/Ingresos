@extends('layouts.app')

@section('template_title')
    {{ $locationsTransaction->name ?? 'Show Locations Transaction' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Locations Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('locations-transactions.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Location Id:</strong>
                            {{ $locationsTransaction->location_id }}
                        </div>
                        <div class="form-group">
                            <strong>Transaction Id:</strong>
                            {{ $locationsTransaction->transaction_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
