@extends('layouts.app')

@section('template_title')
    {{ $profile->name ?? 'Show Profile' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Profile</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('profiles.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $profile->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
