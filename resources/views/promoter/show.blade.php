@extends('layouts.app')

@section('template_title')
    {{ $promoter->name ?? 'Show Promoter' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Promoter</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('promoters.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $promoter->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
