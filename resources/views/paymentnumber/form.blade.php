<div class="form-group">
    {!! Form::label('payment_method_id', 'Payment Method', ['class' => 'control-label']) !!}
    {!! Form::select('payment_method_id', $paymentmethods, old('payment_method_id'), ['class' => 'form-control'] ) !!}
</div>
<div class="form-group">
    {!! Form::label('mobile', 'Number', ['class' => 'control-label']) !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
