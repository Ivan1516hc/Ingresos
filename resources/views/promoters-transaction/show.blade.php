@extends('layouts.app')

@section('template_title')
    {{ $promotersTransaction->name ?? 'Show Promoters Transaction' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Promoters Transaction</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('promoters-transactions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Promoter Id:</strong>
                            {{ $promotersTransaction->promoter_id }}
                        </div>
                        <div class="form-group">
                            <strong>Transaction Id:</strong>
                            {{ $promotersTransaction->transaction_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
