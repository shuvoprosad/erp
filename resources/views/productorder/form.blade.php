
<div class="form-group {{ $errors->has('shipped_by') ? 'has-error' : ''}}">
    {!! Form::label('shipped_by', 'shipped_by', ['class' => 'control-label']) !!}
    {!! Form::select('shipped_by',$shipped_by , old('shipped_by')??isset($productorder)?$productorder->shipped_by:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2'] : ['class' => 'form-control']) !!}
    {!! $errors->first('customer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('shipping_method') ? 'has-error' : ''}}">
    {!! Form::label('shipping_method', 'shipping_method', ['class' => 'control-label']) !!}
    {!! Form::select('shipping_method',$shipping_method , old('shipping_method')??isset($productorder)?$productorder->shipping_method:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2'] : ['class' => 'form-control']) !!}
    {!! $errors->first('customer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_1') ? 'has-error' : ''}}">
    {!! Form::label('status_1', 'status_1', ['class' => 'control-label']) !!}
    {!! Form::select('status_1',$status_1 , old('status_1')??isset($productorder)?$productorder->status_1:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status_2') ? 'has-error' : ''}}">
    {!! Form::label('status_2', 'status_2', ['class' => 'control-label']) !!}
    {!! Form::select('status_2',$status_2 , old('status_2')??isset($productorder)?$productorder->status_2:null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'data-toggle'=>'select2'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status_2', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
