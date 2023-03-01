@extends('layouts.app')

@section('template_title')
    Create Transaction
@endsection

@section('content')
    <section class=" container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">GENERAR MOVIMIENTO</span>
                    </div>
                    <div class="card-body">
                        <form id="myForm" onsubmit="psicologo()" method="POST" role="form"  enctype="multipart/form-data" action="{{ route('transactions.store') }}">
                            @csrf

                            @include('transaction.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
