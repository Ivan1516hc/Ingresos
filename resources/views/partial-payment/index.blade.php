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
                                {{ __('Partial Payment') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('partial-payments.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Beneficiary Id</th>
										<th>Beneficiary Name</th>
										<th>Service Id</th>
										<th>User Id</th>
										<th>Payment</th>
										<th>Partiality</th>
										<th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partialPayments as $partialPayment)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $partialPayment->beneficiary_id }}</td>
											<td>{{ $partialPayment->beneficiary_name }}</td>
											<td>{{ $partialPayment->service_id }}</td>
											<td>{{ $partialPayment->user_id }}</td>
											<td>{{ $partialPayment->payment }}</td>
											<td>{{ $partialPayment->partiality }}</td>
											<td>{{ $partialPayment->status }}</td>

                                            <td>
                                                <form action="{{ route('partial-payments.destroy',$partialPayment->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('partial-payments.show',$partialPayment->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('partial-payments.edit',$partialPayment->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
