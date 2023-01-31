<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('promoter_id') }}
            {{ Form::text('promoter_id', $promotersTransaction->promoter_id, ['class' => 'form-control' . ($errors->has('promoter_id') ? ' is-invalid' : ''), 'placeholder' => 'Promoter Id']) }}
            {!! $errors->first('promoter_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('transaction_id') }}
            {{ Form::text('transaction_id', $promotersTransaction->transaction_id, ['class' => 'form-control' . ($errors->has('transaction_id') ? ' is-invalid' : ''), 'placeholder' => 'Transaction Id']) }}
            {!! $errors->first('transaction_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>