@extends('layouts.app')

@section('template_title')
    {{ $department->name ?? 'Show Department' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Department</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('departments.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Level:</strong>
                            {{ $department->level }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $department->name }}
                        </div>
                        <div class="form-group">
                            <strong>Direction:</strong>
                            {{ $department->direction }}
                        </div>
                        <div class="form-group">
                            <strong>Dependence:</strong>
                            {{ $department->dependence }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
