<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', 'Customer', ['class' => 'control-label']) !!}
    {!! Form::select('customer_id',$customer , old('customer')??isset($productlead)?$productlead->customer:null, ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2']) !!}
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('counter') ? 'has-error' : ''}}">
    {!! Form::label('counter', 'Counter', ['class' => 'control-label']) !!}
    {!! Form::text('counter', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('counter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_0') ? 'has-error' : ''}}">
    {!! Form::label('status_0', 'Status 0', ['class' => 'control-label']) !!}
    {!! Form::select('status_0', $status, old('status_0'), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('status_0', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
