@extends('layouts.app')
@php
    $user = Auth::user();
@endphp
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
                                {{ __('GRUPOS') }}
                            </span>
                            @if ($user->profile_id == 1)
                                <div class="float-right">
                                    <a href="{{ route('groups.create') }}" class="btn btn-primary btn-sm float-right"
                                        data-placement="left">
                                        {{ __('Crear Nuevo') }}
                                    </a>
                                </div>
                            @endif

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

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $group->name }}</td>

                                            <td>
                                                @if ($user->profile_id == 1)
                                                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('groups.edit', $group->id) }}"><i
                                                                class="la la-fw la-edit icon-button"></i> Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="la la-fw la-trash icon-button"></i> Eliminar</button>
                                                    </form>
                                                @endif
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
