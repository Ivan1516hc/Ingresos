@extends('layouts.app')

@section('template_title')
    Update Cancellation History
@endsection

@section('content')
    <section class="container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Cancellation History</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cancellation-histories.update', $cancellationHistory->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('cancellation-history.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
