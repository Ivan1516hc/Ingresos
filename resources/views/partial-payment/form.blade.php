<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('beneficiary_id') }}
            {{ Form::text('beneficiary_id', $partialPayment->beneficiary_id, ['class' => 'form-control' . ($errors->has('beneficiary_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Id']) }}
            {!! $errors->first('beneficiary_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiary_name') }}
            {{ Form::text('beneficiary_name', $partialPayment->beneficiary_name, ['class' => 'form-control' . ($errors->has('beneficiary_name') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Name']) }}
            {!! $errors->first('beneficiary_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('service_id') }}
            {{ Form::text('service_id', $partialPayment->service_id, ['class' => 'form-control' . ($errors->has('service_id') ? ' is-invalid' : ''), 'placeholder' => 'Service Id']) }}
            {!! $errors->first('service_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $partialPayment->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('payment') }}
            {{ Form::text('payment', $partialPayment->payment, ['class' => 'form-control' . ($errors->has('payment') ? ' is-invalid' : ''), 'placeholder' => 'Payment']) }}
            {!! $errors->first('payment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('partiality') }}
            {{ Form::text('partiality', $partialPayment->partiality, ['class' => 'form-control' . ($errors->has('partiality') ? ' is-invalid' : ''), 'placeholder' => 'Partiality']) }}
            {!! $errors->first('partiality', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $partialPayment->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>