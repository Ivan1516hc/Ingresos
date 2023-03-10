@extends('layouts.app')

@section('template_title')
    Update Locations Transaction
@endsection

@section('content')
    <section class="container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Locations Transaction</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('locations-transactions.update', $locationsTransaction->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('locations-transaction.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
