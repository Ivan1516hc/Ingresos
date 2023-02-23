@extends('layouts.app')

@section('template_title')
    Location
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Location') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('locations.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Name</th>
										<th>Descripcion</th>
										<th>Group Id</th>
										<th>Department Id</th>
										<th>Manager Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $location->name }}</td>
											<td>{{ $location->descripcion }}</td>
											<td>{{ $location->group->name}}</td>
											<td>{{ $location->department_id }}</td>
											<td>{{ $location->user->name ?? null}}</td>

                                            <td>
                                                <form action="{{ route('locations.destroy',$location->id) }}" method="POST">
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
                {!! $locations->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
