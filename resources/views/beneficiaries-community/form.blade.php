<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('beneficiary_id') }}
            {{ Form::text('beneficiary_id', $beneficiariesCommunity->beneficiary_id, ['class' => 'form-control' . ($errors->has('beneficiary_id') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Id']) }}
            {!! $errors->first('beneficiary_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('beneficiary_name') }}
            {{ Form::text('beneficiary_name', $beneficiariesCommunity->beneficiary_name, ['class' => 'form-control' . ($errors->has('beneficiary_name') ? ' is-invalid' : ''), 'placeholder' => 'Beneficiary Name']) }}
            {!! $errors->first('beneficiary_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('community_id') }}
            {{ Form::text('community_id', $beneficiariesCommunity->community_id, ['class' => 'form-control' . ($errors->has('community_id') ? ' is-invalid' : ''), 'placeholder' => 'Community Id']) }}
            {!! $errors->first('community_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>