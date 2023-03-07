@extends('layouts.app')

@section('template_title')
    Reprint History
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reprint History') }}
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
                                        
										<th>Movimiento</th>
										<th>Usuario</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reprintHistories as $reprintHistory)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $reprintHistory->transaction_id}}</td>
											<td>{{ $reprintHistory->user->name}}</td>
                                            <td>{{ $reprintHistory->created_at->format('d-m-Y')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $reprintHistories->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
