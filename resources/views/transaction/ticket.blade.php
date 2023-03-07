<style>
    section.container {
        height: 700px;
        overflow: hidden;
    }
</style>
@extends('layouts.ticket')
@php
    use Carbon\Carbon;
@endphp
@section('template_title')
    {{ $transaction->name ?? 'Show Transaction' }}
@endsection

@section('content')
    <section class="container">
        <div class=" mr-4 d-flex ">
            <img src="../../assets/img/Logo_DIF.png" width="150" height="150" alt="InternetCtrl">
            <div class="text-uppercase align-items-center d-flex" style="margin-inline-start: auto;">
                Sistema para el desarrollo integral de la familia <br> Municipio de Zapopan</div>
        </div>
        <div class="text-center">
            <h5>{{ $transaction->user->location->descripcion }}</h5>
        </div>
        <div class="card-body row">
            <div class=" form-group text-right">
                <strong>Folio:</strong>
                {{ $transaction->invoice }}
                <br>
                <strong>Fecha:</strong>
                {{ $transaction->created_at->format('d/m/Y') }}
            </div>

            <div class=" col-6 form-group">
                {{ $transaction->beneficiary_id }} -
                {{ $transaction->beneficiary_name }}
            </div>
            <div class="col-12 form-group">
                <table class="table table-sm table-hover">
                    <thead class="thead">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service_transaction as $key => $service)
                            @if ($key < 6)
                                <tr>
                                    <td>{{ $service->service->name }}</td>
                                    <td>{{ $service->amount }}</td>
                                    @if ($partial)
                                        <td>$ {{ $service->service->cost / 5 }}</td>
                                    @else
                                        <td>$ {{ $service->service->cost }}</td>
                                    @endif
                                    <td>$ {{ $service->cost }}</td>
                                </tr>
                            @else
                            @break
                        @endif
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>TOTAL:</td>
                        <td>$ {{ $transaction->total }}</td>
                    </tr>
                </tfoot>
            </table>
            <p>{{ $transaction->numberToWord }}.</p>
        </div>
        @if ($partial)
            <div class="form-group">
                <strong>TOTAL ABONADO:</strong>
                $ {{ $partial->partialPayment->payment }} <br>
                <strong>DEUDA RESTANTE:</strong>
                $ {{ $service->service->cost - $partial->partialPayment->payment }}
            </div>
        @endif
        @if ($promoter)
            <div class="form-group">
                <strong>Promotor:</strong>
                {{ $promoter->promoter->name }}
            </div>
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
        <div class="text-center"><strong>COPIA RECURSOS FINANCIEROS</strong></div>
    </div>
</section>
<hr class="mt-5">
<section class="container">
    <div class=" mr-4 d-flex ">
        <img src="../../assets/img/Logo_DIF.png" width="150" height="150" alt="InternetCtrl">
        <div class="text-uppercase align-items-center d-flex" style="margin-inline-start: auto;">
            Sistema para el desarrollo integral de la familia <br> Municipio de Zapopan</div>
    </div>
    <div class="text-center">
        <h5>{{ $transaction->user->location->descripcion }}</h5>
    </div>
    <div class="card-body row">
        <div class=" form-group text-right">
            <strong>Folio:</strong>
            {{ $transaction->invoice }}
            <br>
            <strong>Fecha:</strong>
            {{ $transaction->created_at->format('d/m/Y') }}
        </div>

        <div class=" col-6 form-group">
            {{ $transaction->beneficiary_id }} -
            {{ $transaction->beneficiary_name }}
        </div>
        <div class="col-12 form-group">
            <table class="table table-sm table-hover">
                <thead class="thead">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service_transaction as $key => $service)
                        @if ($key < 6)
                            <tr>
                                <td>{{ $service->service->name }}</td>
                                <td>{{ $service->amount }}</td>
                                @if ($partial)
                                    <td>$ {{ $service->service->cost / 5 }}</td>
                                @else
                                    <td>$ {{ $service->service->cost }}</td>
                                @endif
                                <td>$ {{ $service->cost }}</td>
                            </tr>
                        @else
                        @break
                    @endif
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL:</td>
                    <td>$ {{ $transaction->total }}</td>
                </tr>
            </tfoot>
        </table>
        <p>{{ $transaction->numberToWord }}.</p>
    </div>
    @if ($partial)
        <div class="form-group">
            <strong>TOTAL ABONADO:</strong>
            $ {{ $partial->partialPayment->payment }} <br>
            <strong>DEUDA RESTANTE:</strong>
            $ {{ $service->service->cost - $partial->partialPayment->payment }}
        </div>
    @endif
    @if ($promoter)
        <div class="form-group">
            <strong>Promotor:</strong>
            {{ $promoter->promoter->name }}
        </div>
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
    <div class="text-center"><strong>COPIA BENEFICIARIO</strong></div>
</div>
</section>
@endsection
