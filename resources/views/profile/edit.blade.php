@extends('layouts.app')

@section('template_title')
    Update Profile
@endsection

@section('content')
    <section class="container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Profile</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profiles.update', $profile->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('profile.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
