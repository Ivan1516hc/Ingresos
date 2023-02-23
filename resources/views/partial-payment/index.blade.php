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
											<td>{{($partialPayment->status == 1 ?'Adeudo' : 'Pagado' )}}</td>

                                            <td>
                                                <form action="{{ route('partial-payments.destroy',$partialPayment->id) }}" method="POST">
                                                    <a class="btn btn-sm bg-primary" href="{{ route('partial-payments.edit',$partialPayment->id) }}"><i class="la la-fw la-edit icon-button"></i>Abonar</a>
                                                    @csrf
                                                </form>
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
