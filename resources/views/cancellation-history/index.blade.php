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
                                {{ __('Cancellation History') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cancellation-histories.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Transaction Id</th>
										<th>User Id</th>
										<th>Authorized User Id</th>
										<th>Reason</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cancellationHistories as $cancellationHistory)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cancellationHistory->transaction_id }}</td>
											<td>{{ $cancellationHistory->user_id }}</td>
											<td>{{ $cancellationHistory->authorized_user_id }}</td>
											<td>{{ $cancellationHistory->reason }}</td>

                                            <td>
                                                <form action="{{ route('cancellation-histories.destroy',$cancellationHistory->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cancellation-histories.show',$cancellationHistory->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cancellation-histories.edit',$cancellationHistory->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $cancellationHistories->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
