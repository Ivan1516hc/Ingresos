@extends('layouts.app')

@section('template_title')
    {{ $cancellationHistory->name ?? 'Show Cancellation History' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cancellation History</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cancellation-histories.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Transaction Id:</strong>
                            {{ $cancellationHistory->transaction_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $cancellationHistory->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
