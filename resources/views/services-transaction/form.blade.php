<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('transaction_id') }}
            {{ Form::text('transaction_id', $servicesTransaction->transaction_id, ['class' => 'form-control' . ($errors->has('transaction_id') ? ' is-invalid' : ''), 'placeholder' => 'Transaction Id']) }}
            {!! $errors->first('transaction_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('service_id') }}
            {{ Form::text('service_id', $servicesTransaction->service_id, ['class' => 'form-control' . ($errors->has('service_id') ? ' is-invalid' : ''), 'placeholder' => 'Service Id']) }}
            {!! $errors->first('service_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>