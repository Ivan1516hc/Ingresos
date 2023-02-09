@extends('layouts.app')

@section('template_title')
    {{ $location->name ?? 'Show Location' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Location</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('locations.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $location->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $location->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Group Id:</strong>
                            {{ $location->group_id }}
                        </div>
                        <div class="form-group">
                            <strong>Department Id:</strong>
                            {{ $location->department_id }}
                        </div>
                        <div class="form-group">
                            <strong>Manager Id:</strong>
                            {{ $location->manager_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
