@extends('layouts.app')
@php
    use Carbon\Carbon;
    $user = Auth::user();
@endphp
@section('template_title')
    Transaction
@endsection

@section('content')
    <div class="container-fluid dashboard">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('MOVIMIENTOS') }}
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
                            <table class="table table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Folio</th>
                                        <th>Monto</th>
                                        <th>Nombre Cajero</th>
                                        <th>Centro</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>$ {{ $transaction->transaction->total }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ $transaction->transaction->location->name }}</td>
                                            <td>{{ $transaction->status == 1
                                                ? 'CANCELADO'
                                                : ($transaction->status == 2
                                                    ? 'PENDIENTE'
                                                    : ($transaction->status == 3
                                                        ? 'SOLICITUD CANCELADA'
                                                        : ($transaction->status == 4
                                                            ? 'SOLICITUD RECHAZADA'
                                                            : null))) }}
                                            </td>
                                            <td>{{ $transaction->transaction->created_at->format('d-m-Y') }}</td>

                                            <td>
                                                <form action="{{ route('cancel-transactions.destroy', $transaction->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-md btn-primary "
                                                        href="{{ route('cancel-transactions.show', $transaction->id) }}"><i
                                                            class="la la-fw la-eye icon-button"></i> Ver</a>
                                                    @csrf
                                                </form>
                                                @if ($user->profile_id == 5 && $transaction->created_at->isCurrentMonth() && $transaction->status == 2)
                                                    <button onclick="cancelJD({{ $transaction }})"
                                                        class="btn btn-md btn-danger">
                                                        <i class="la la-edit icon-button"></i> Autorizar Cancelación
                                                    </button>
                                                @endif
                                                @if ($user->profile_id == 2 && $transaction->status == 2 && $transaction->transaction->created_at >= now()->subDays(3))
                                                    <button onclick="cancelJD({{ $transaction }})"
                                                        class="btn btn-md btn-danger">
                                                        <i class="la la-edit icon-button"></i> Autorizar Cancelación
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $transactions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

<script src="../../js/cancelTransactions.js"></script>
