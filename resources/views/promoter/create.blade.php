@extends('layouts.app')

@section('template_title')
    Create Promoter
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Promoter</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('promoters.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('promoter.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
