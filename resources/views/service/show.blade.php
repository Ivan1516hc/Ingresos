@extends('layouts.app')

@section('template_title')
    {{ $service->name ?? 'Show Service' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Service</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $service->name }}
                        </div>
                        <div class="form-group">
                            <strong>Cost:</strong>
                            {{ $service->cost }}
                        </div>
                        <div class="form-group">
                            <strong>Type Income:</strong>
                            {{ $service->type_income }}
                        </div>
                        <div class="form-group">
                            <strong>Code Income:</strong>
                            {{ $service->code_income }}
                        </div>
                        <div class="form-group">
                            <strong>Not Binding:</strong>
                            {{ $service->not_binding }}
                        </div>
                        <div class="form-group">
                            <strong>Id Gu:</strong>
                            {{ $service->id_gu }}
                        </div>
                        <div class="form-group">
                            <strong>Partial:</strong>
                            {{ $service->partial }}
                        </div>
                        <div class="form-group">
                            <strong>Unit:</strong>
                            {{ $service->unit }}
                        </div>
                        <div class="form-group">
                            <strong>Leadership:</strong>
                            {{ $service->leadership }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
