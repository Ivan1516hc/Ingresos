@extends('layouts.app')

@section('template_title')
    Create Reprint History
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Reprint History</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reprint-histories.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('reprint-history.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
