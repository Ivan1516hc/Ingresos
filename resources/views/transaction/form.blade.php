<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('invoice') }}
            {{ Form::text('invoice', $transaction->invoice, ['class' => 'form-control' . ($errors->has('invoice') ? ' is-invalid' : ''), 'placeholder' => 'Invoice']) }}
            {!! $errors->first('invoice', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bill') }}
            {{ Form::text('bill', $transaction->bill, ['class' => 'form-control' . ($errors->has('bill') ? ' is-invalid' : ''), 'placeholder' => 'Bill']) }}
            {!! $errors->first('bill', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('total') }}
            {{ Form::text('total', $transaction->total, ['class' => 'form-control' . ($errors->has('total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
            {!! $errors->first('total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiary_id') }}
            {{ Form::text('beneficiary_id', $transaction->beneficiary_id, ['class' => 'form-control' . ($errors->has('beneficiary_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Id']) }}
            {!! $errors->first('beneficiary_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiary_name') }}
            {{ Form::text('beneficiary_name', $transaction->beneficiary_name, ['class' => 'form-control' . ($errors->has('beneficiary_name') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Name']) }}
            {!! $errors->first('beneficiary_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('location_id') }}
            {{ Form::text('location_id', $transaction->location_id, ['class' => 'form-control' . ($errors->has('location_id') ? ' is-invalid' : ''), 'placeholder' => 'Location Id']) }}
            {!! $errors->first('location_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $transaction->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $transaction->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>