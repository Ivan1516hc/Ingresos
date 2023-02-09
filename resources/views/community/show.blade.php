@extends('layouts.app')

@section('template_title')
    {{ $community->name ?? 'Show Community' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Community</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('communities.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $community->name }}
                        </div>
                        <div class="form-group">
                            <strong>Location Id:</strong>
                            {{ $community->location_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
