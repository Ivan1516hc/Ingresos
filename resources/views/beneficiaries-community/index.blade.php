@extends('layouts.app')

@section('template_title')
    Beneficiaries Community
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Beneficiaries Community') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('beneficiaries-communities.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
                                        
										<th>Beneficiary Id</th>
										<th>Beneficiary Name</th>
										<th>Community Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beneficiariesCommunities as $beneficiariesCommunity)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $beneficiariesCommunity->beneficiary_id }}</td>
											<td>{{ $beneficiariesCommunity->beneficiary_name }}</td>
											<td>{{ $beneficiariesCommunity->community_id }}</td>

                                            <td>
                                                <form action="{{ route('beneficiaries-communities.destroy',$beneficiariesCommunity->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('beneficiaries-communities.show',$beneficiariesCommunity->id) }}"><i class="la la-fw la-eye icon-button"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('beneficiaries-communities.edit',$beneficiariesCommunity->id) }}"><i class="la la-fw la-edit icon-button"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="la la-fw la-trash icon-button"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $beneficiariesCommunities->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
