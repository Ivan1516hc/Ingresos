@extends('layouts.app')

@section('template_title')
    Community
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Community') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('communities.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre</th>
										<th>Location Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communities as $community)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $community->name }}</td>
											<td>{{ $community->location_id }}</td>

                                            <td>
                                                <form action="{{ route('communities.destroy',$community->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('communities.show',$community->id) }}"><i class="la la-fw la-eye icon-button"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('communities.edit',$community->id) }}"><i class="la la-fw la-edit icon-button"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="la la-fw la-trash icon-button"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $communities->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
