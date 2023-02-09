@extends('layouts.app')

@section('template_title')
    {{ $beneficiariesCommunity->name ?? 'Show Beneficiaries Community' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Beneficiaries Community</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('beneficiaries-communities.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Beneficiary Id:</strong>
                            {{ $beneficiariesCommunity->beneficiary_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiary Name:</strong>
                            {{ $beneficiariesCommunity->beneficiary_name }}
                        </div>
                        <div class="form-group">
                            <strong>Community Id:</strong>
                            {{ $beneficiariesCommunity->community_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
