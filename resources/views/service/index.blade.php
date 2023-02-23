@extends('layouts.app')

@section('template_title')
    Servicio
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Servicio') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Costo</th>
										<th>Tipo de ingreso</th>
										<th>Codigo de ingreso</th>
										<th>Vinculante</th>
										<th>Pagos Parciales</th>
										<th>Unidad</th>
										<th>Dirección</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $service->name }}</td>
											<td>{{ $service->cost }}</td>
											<td>{{ $service->type_income }}</td>
											<td>{{ $service->code_income }}</td>
											<td>{{ $service->not_binding }}</td>
											<td>{{ $service->partial }}</td>
											<td>{{ $service->unit }}</td>
											<td>{{ $service->leadership }}</td>

                                            <td>
                                                <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('services.edit',$service->id) }}"><i class="la la-fw la-edit icon-button"></i> Edit</a>
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
                {!! $services->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
