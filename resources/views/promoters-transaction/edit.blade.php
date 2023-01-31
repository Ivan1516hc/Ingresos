@extends('layouts.app')

@section('template_title')
    Update Promoters Transaction
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Promoters Transaction</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('promoters-transactions.update', $promotersTransaction->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('promoters-transaction.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
