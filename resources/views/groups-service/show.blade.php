@extends('layouts.app')

@section('template_title')
    {{ $groupsService->name ?? 'Show Groups Service' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Groups Service</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('groups-services.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Group Id:</strong>
                            {{ $groupsService->group_id }}
                        </div>
                        <div class="form-group">
                            <strong>Service Id:</strong>
                            {{ $groupsService->service_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
