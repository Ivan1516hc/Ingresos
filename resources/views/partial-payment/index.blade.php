@extends('layouts.app')

@section('template_title')
    Partial Payment
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('PAGOS PARCIALES') }}
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

                                        <th>Beneficiario</th>
                                        <th>Servicio</th>
                                        <th>Usuario</th>
                                        <th>Abonado</th>
                                        <th>Total</th>
                                        <th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partialPayments as $partialPayment)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $partialPayment->beneficiary_id }}</td>
                                            <td>{{ $partialPayment->service->name }}</td>
                                            <td>{{ $partialPayment->user->name }}</td>
                                            <td>$ {{ $partialPayment->payment }}</td>
                                            <td>$ {{ $partialPayment->service->cost }}</td>
                                            <td>{{ $partialPayment->status == 1 ? 'Adeudo' : 'Pagado' }}</td>
                                            <td>
                                                @if ($partialPayment->status == 1)
                                                    <button onclick="modal({{$partialPayment}})"
                                                        class="btn btn-md btn-primary">
                                                        <i class="la la-box icon-button"></i> Abonar
                                                    </button>
                                                    <button onclick="cancel({{ $partialPayment->id}})"
                                                        class="btn btn-md btn-danger">
                                                        <i class="la la-box icon-button"></i> Terminar
                                                    </button>
                                                @else
                                                    @if ($partialPayment->payment != $partialPayment->service->cost)
                                                        <button onclick="cancel({{ $partialPayment->id}})"
                                                            class="btn btn-md btn-info">
                                                            <i class="la la-box icon-button"></i>Reactivar
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $partialPayments->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection

<script src="../../js/partialPayment.js"></script>

<!--Modal: modalPush-->
<div class="modal fade centerModal" id="modalPagosParciales" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading text-primary">Pagos Parciales</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p id='text'></p>
            </div>
            <!--Footer-->
            <div class="modal-footer flex-center align-self-center">
                <button type="button" id="abono" class="btn btn-primary">Generar Abono</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalPush-->

