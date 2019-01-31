
<div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
    {!! Form::label('payment_type', 'Payment type', ['class' => 'control-label']) !!}
    {!! Form::select('payment_type', $payment_type, old('payment_type'), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('Payment_number') ? 'has-error' : ''}}">
    {!! Form::label('Payment_number', 'Payment number', ['class' => 'control-label']) !!}
    {!! Form::select('Payment_number', $Payment_number, old('Payment_number'), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('Payment_number', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('Paid_amount') ? 'has-error' : ''}}">
    {!! Form::label('Paid_amount', 'Paid amount', ['class' => 'control-label']) !!}
    {!! Form::text('Paid_amount', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('Paid_amount', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
