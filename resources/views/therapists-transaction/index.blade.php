@extends('layouts.app')

@section('template_title')
    Therapists Transaction
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Therapists Transaction') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('therapists-transactions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Therapist Id</th>
										<th>Transaction Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($therapistsTransactions as $therapistsTransaction)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $therapistsTransaction->therapist_id }}</td>
											<td>{{ $therapistsTransaction->transaction_id }}</td>

                                            <td>
                                                <form action="{{ route('therapists-transactions.destroy',$therapistsTransaction->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('therapists-transactions.show',$therapistsTransaction->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('therapists-transactions.edit',$therapistsTransaction->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $therapistsTransactions->links() !!}
            </div>
        </div>
    </div>
@endsection
