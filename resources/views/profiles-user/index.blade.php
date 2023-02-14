@extends('layouts.app')

@section('template_title')
    Profiles User
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Profiles User') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('profiles-users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Profile Id</th>
										<th>User Id</th>
										<th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profilesUsers as $profilesUser)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $profilesUser->profile_id }}</td>
											<td>{{ $profilesUser->user_id }}</td>
											<td>{{ $profilesUser->status }}</td>

                                            <td>
                                                <form action="{{ route('profiles-users.destroy',$profilesUser->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('profiles-users.show',$profilesUser->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('profiles-users.edit',$profilesUser->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $profilesUsers->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
