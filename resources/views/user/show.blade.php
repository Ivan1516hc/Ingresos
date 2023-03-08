@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? 'Show User' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Usuario {{$user->id}}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $user->username }}
                        </div>
                        <div class="form-group">
                            <strong>Puesto:</strong>
                            {{ $user->post }}
                        </div>
                        <div class="form-group">
                            <strong>Centro:</strong>
                            {{ $user->location->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
