@extends('layouts.app')

@section('template_title')
    Group
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Group') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('groups.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $group->name }}</td>

                                            <td>
                                                <form action="{{ route('groups.destroy',$group->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('groups.show',$group->id) }}"><i class="la la-fw la-eye icon-button"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('groups.edit',$group->id) }}"><i class="la la-fw la-edit icon-button"></i> Edit</a>
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
                {!! $groups->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
