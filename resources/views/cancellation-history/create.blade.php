@extends('layouts.app')

@section('template_title')
    Create Cancellation History
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Cancellation History</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cancellation-histories.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('cancellation-history.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
