<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('location_id') }}
            {{ Form::text('location_id', $locationsTransaction->location_id, ['class' => 'form-control' . ($errors->has('location_id') ? ' is-invalid' : ''), 'placeholder' => 'Location Id']) }}
            {!! $errors->first('location_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('transaction_id') }}
            {{ Form::text('transaction_id', $locationsTransaction->transaction_id, ['class' => 'form-control' . ($errors->has('transaction_id') ? ' is-invalid' : ''), 'placeholder' => 'Transaction Id']) }}
            {!! $errors->first('transaction_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>