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
                                        <th>Total</th>
                                        <th>Id Beneficiario</th>
                                        <th>Nombre Beneficiario</th>
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

                                            <td>{{ $transaction->invoice }}</td>
                                            <td>{{ $transaction->total }}</td>
                                            <td>{{ $transaction->beneficiary_id }}</td>
                                            <td>{{ $transaction->beneficiary_name }}</td>
                                            <td>{{ $transaction->location->name }}</td>
                                            <td>{{ $transaction->status }}</td>
                                            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>

                                            <td>
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-md btn-primary "
                                                        href="{{ route('transactions.show', $transaction->id) }}"><i
                                                            class="la la-fw la-eye icon-button"></i> Ver</a>
                                                    @csrf
                                                    @if ($user->profile_id == 3)
                                                        @if ($transaction->created_at->isToday())
                                                            <button type="submit" class="btn btn-md btn-danger">
                                                                <i class="la la-edit icon-button"></i> Cancelar
                                                            </button>
                                                        @elseif ($transaction->created_at->isCurrentMonth())
                                                            <button type="submit"
                                                                class="btn btn-md bg-secondary text-light">
                                                                <i class="la la-edit icon-button"></i> Solicitar Cencelación
                                                            </button>
                                                        @endif
                                                    @endif
                                                </form>
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
