@extends('layouts.app')

@section('template_title')
    Services Transaction
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Services Transaction') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('services-transactions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Transaction Id</th>
										<th>Service Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicesTransactions as $servicesTransaction)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $servicesTransaction->transaction_id }}</td>
											<td>{{ $servicesTransaction->service_id }}</td>

                                            <td>
                                                <form action="{{ route('services-transactions.destroy',$servicesTransaction->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('services-transactions.show',$servicesTransaction->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('services-transactions.edit',$servicesTransaction->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $servicesTransactions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
