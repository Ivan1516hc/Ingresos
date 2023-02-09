@extends('layouts.app')

@section('template_title')
    {{ $profilesUser->name ?? 'Show Profiles User' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Profiles User</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('profiles-users.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Profile Id:</strong>
                            {{ $profilesUser->profile_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $profilesUser->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $profilesUser->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
