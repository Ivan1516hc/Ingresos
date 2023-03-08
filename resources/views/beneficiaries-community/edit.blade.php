@extends('layouts.app')

@section('template_title')
    Update Beneficiaries Community
@endsection

@section('content')
    <section class="container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Beneficiaries Community</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('beneficiaries-communities.update', $beneficiariesCommunity->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('beneficiaries-community.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
