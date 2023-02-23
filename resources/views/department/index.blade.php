@extends('layouts.app')

@section('template_title')
    Department
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Department') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Level</th>
										<th>Name</th>
										<th>Direction</th>
										<th>Dependence</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $department->level }}</td>
											<td>{{ $department->name }}</td>
											<td>{{ $department->direction }}</td>
											<td>{{ $department->dependence }}</td>

                                            <td>
                                                <form action="{{ route('departments.destroy',$department->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('departments.show',$department->id) }}"><i class="la la-fw la-eye icon-button"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('departments.edit',$department->id) }}"><i class="la la-fw la-edit icon-button"></i> Edit</a>
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
                {!! $departments->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
