@extends('layouts.app')

@section('template_title')
    Locations Transaction
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Locations Transaction') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('locations-transactions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table  table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Location Id</th>
										<th>Transaction Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locationsTransactions as $locationsTransaction)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $locationsTransaction->location_id }}</td>
											<td>{{ $locationsTransaction->transaction_id }}</td>

                                            <td>
                                                <form action="{{ route('locations-transactions.destroy',$locationsTransaction->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('locations-transactions.show',$locationsTransaction->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('locations-transactions.edit',$locationsTransaction->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $locationsTransactions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
