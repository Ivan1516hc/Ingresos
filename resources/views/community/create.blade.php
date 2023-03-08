@extends('layouts.app')

@section('template_title')
    Create Community
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Community</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('communities.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('community.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
