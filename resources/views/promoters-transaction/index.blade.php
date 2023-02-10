@extends('layouts.app')

@section('template_title')
    Promoters Transaction
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Promoters Transaction') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('promoters-transactions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Promoter Id</th>
										<th>Transaction Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotersTransactions as $promotersTransaction)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $promotersTransaction->promoter_id }}</td>
											<td>{{ $promotersTransaction->transaction_id }}</td>

                                            <td>
                                                <form action="{{ route('promoters-transactions.destroy',$promotersTransaction->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('promoters-transactions.show',$promotersTransaction->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('promoters-transactions.edit',$promotersTransaction->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $promotersTransactions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
