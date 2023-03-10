@extends('layouts.app')

@section('template_title')
    Create Profile
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Profile</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('profile.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
