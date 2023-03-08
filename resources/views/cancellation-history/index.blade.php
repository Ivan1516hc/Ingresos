@extends('layouts.app')

@section('template_title')
    Cancellation History
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('HISTORIAL DE CANCELACIÓN') }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Movimiento</th>
                                        <th>Usuario</th>
                                        <th>Autorización</th>
                                        <th>Razón</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cancellationHistories as $cancellationHistory)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $cancellationHistory->transaction_id }}</td>
                                            <td>{{ $cancellationHistory->user->name}}</td>
                                            <td>{{ $cancellationHistory->users }}</td>
                                            <td>{{ $cancellationHistory->reason }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cancellationHistories->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
