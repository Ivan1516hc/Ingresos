@extends('layouts.app')

@section('template_title')
    Create Beneficiaries Community
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Beneficiaries Community</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('beneficiaries-communities.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('beneficiaries-community.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
