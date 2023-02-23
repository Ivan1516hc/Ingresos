<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $location->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Descripción') }}
            {{ Form::text('descripcion', $location->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('group_id', 'Group') }}
            <select name="group_id" id="group_id" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                <option value="">--Selecciona Grupo--</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $location->group_id == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('group_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('department_id', 'Department') }}
            <select name="department_id" id="department_id"
                class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}">
                <option value="">--Selecciona Departamento--</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ $location->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('manager_id', 'Manager') }}
            <select name="manager_id" id="manager_id"
                class="form-control{{ $errors->has('manager_id') ? ' is-invalid' : '' }}">
                <option value="">--Selecciona Responsable--</option>
                @foreach ($users as $manager)
                    <option value="{{ $manager->id }}" {{ $location->manager_id == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('manager_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
