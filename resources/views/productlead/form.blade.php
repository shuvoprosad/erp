<div class="form-group {{ $errors->has('status_0') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', 'Customer', ['class' => 'control-label']) !!}
    {!! Form::select('customer_id',$customer , old('customer')??isset($productlead)?$productlead->customer:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2'] : ['class' => 'form-control']) !!}
    {!! $errors->first('customer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('counter') ? 'has-error' : ''}}">
    {!! Form::label('counter', 'Counter', ['class' => 'control-label']) !!}
    {!! Form::text('counter', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('counter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_0') ? 'has-error' : ''}}">
    {!! Form::label('status_0', 'Status 0', ['class' => 'control-label']) !!}
    {!! Form::select('status_0', $status, old('status')??isset($productlead)?$productlead->status_0:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status_0', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
