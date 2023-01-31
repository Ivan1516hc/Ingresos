<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('therapist_id') }}
            {{ Form::text('therapist_id', $therapistsTransaction->therapist_id, ['class' => 'form-control' . ($errors->has('therapist_id') ? ' is-invalid' : ''), 'placeholder' => 'Therapist Id']) }}
            {!! $errors->first('therapist_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('transaction_id') }}
            {{ Form::text('transaction_id', $therapistsTransaction->transaction_id, ['class' => 'form-control' . ($errors->has('transaction_id') ? ' is-invalid' : ''), 'placeholder' => 'Transaction Id']) }}
            {!! $errors->first('transaction_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>