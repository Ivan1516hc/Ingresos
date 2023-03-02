@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@section('template_title')
    {{ $transaction->name ?? 'Show Transaction' }}
@endsection

@section('content')
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="mr-4 text-right mt-3 text-uppercase">
                        <p>Sistema para el desarrollo integral de la familia <br> Municipio de Zapopan</p>
                    </div>
                    <div class="text-center">
                        <h5>CENTRO DE ATENCION PSICOLOGICA</h5>
                    </div>
                    <hr>
                    <div class="card-body row">
                        <div class="col-2 offset-10 form-group">
                            <strong>Folio:</strong>
                            {{ $transaction->invoice }}
                            <br>
                            <strong>Fecha:</strong>
                            {{ Carbon::now()->format('d/m/Y') }}
                        </div>

                        <div class=" col-6 form-group">
                            {{ $transaction->beneficiary_id }}
                            {{ $transaction->beneficiary_name }}
                        </div>
                        <div class="col-12 form-group">
                            <table class="table  table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service_transaction as $service)
                                        <tr>
                                            <td>{{ $service->service->name }}</td>
                                            <td>{{ $service->amount }}</td>
                                            <td>$ {{ $service->service->cost }}</td>
                                            <td>$ {{ $service->cost }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>TOTAL:</td>
                                        <td>$ {{ $transaction->total }}</td>
                                </tfoot>
                            </table>
                            <p></p>
                        </div>
                        @if ($promoter)
                            <p>LLLLLLLLLLLLLLLLL</p>
                        @endif
                        @if ($therapist)
                            <div class="form-group">
                                <strong>Terapeuta:</strong>
                                {{ $therapist->therapist->name }}
                            </div>
                        @endif
                        <div class="form-group">
                            <strong>Atendido por:</strong>
                            {{ $transaction->user->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
