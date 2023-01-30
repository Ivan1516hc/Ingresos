<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $service->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cost') }}
            {{ Form::text('cost', $service->cost, ['class' => 'form-control' . ($errors->has('cost') ? ' is-invalid' : ''), 'placeholder' => 'Cost']) }}
            {!! $errors->first('cost', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type_income') }}
            {{ Form::text('type_income', $service->type_income, ['class' => 'form-control' . ($errors->has('type_income') ? ' is-invalid' : ''), 'placeholder' => 'Type Income']) }}
            {!! $errors->first('type_income', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code_income') }}
            {{ Form::text('code_income', $service->code_income, ['class' => 'form-control' . ($errors->has('code_income') ? ' is-invalid' : ''), 'placeholder' => 'Code Income']) }}
            {!! $errors->first('code_income', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('not_binding') }}
            {{ Form::text('not_binding', $service->not_binding, ['class' => 'form-control' . ($errors->has('not_binding') ? ' is-invalid' : ''), 'placeholder' => 'Not Binding']) }}
            {!! $errors->first('not_binding', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_gu') }}
            {{ Form::text('id_gu', $service->id_gu, ['class' => 'form-control' . ($errors->has('id_gu') ? ' is-invalid' : ''), 'placeholder' => 'Id Gu']) }}
            {!! $errors->first('id_gu', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('partial') }}
            {{ Form::text('partial', $service->partial, ['class' => 'form-control' . ($errors->has('partial') ? ' is-invalid' : ''), 'placeholder' => 'Partial']) }}
            {!! $errors->first('partial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unit') }}
            {{ Form::text('unit', $service->unit, ['class' => 'form-control' . ($errors->has('unit') ? ' is-invalid' : ''), 'placeholder' => 'Unit']) }}
            {!! $errors->first('unit', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('leadership') }}
            {{ Form::text('leadership', $service->leadership, ['class' => 'form-control' . ($errors->has('leadership') ? ' is-invalid' : ''), 'placeholder' => 'Leadership']) }}
            {!! $errors->first('leadership', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>