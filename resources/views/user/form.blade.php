<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Usuario') }}
            {{ Form::text('username', $user->username, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'placeholder' => 'Username']) }}
            {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Puesto') }}
            {{ Form::text('post', $user->post, ['class' => 'form-control' . ($errors->has('post') ? ' is-invalid' : ''), 'placeholder' => 'Post']) }}
            {!! $errors->first('post', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="location_id">Ubicación</label>
            <select id="location_id" name="location_id" class="form-control{{ $errors->has('location_id') ? ' is-invalid' : '' }}">
                <option value="">--Selecciona una Ubicación--</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ $location->id == $user->location_id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('location_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

<script src="../../js/forms.js"></script>