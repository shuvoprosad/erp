
@if((auth()->user()->can('product.type.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', $productTypes, old('type'), ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.name.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.sku.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
    {!! Form::label('sku', 'SKU', ['class' => 'control-label']) !!}
    {!! Form::text('sku', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.buy_price.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('buy_price') ? 'has-error' : ''}}">
    {!! Form::label('buy_price', 'Buy price', ['class' => 'control-label']) !!}
    {!! Form::text('buy_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('buy_price', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.sell_price.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('sell_price') ? 'has-error' : ''}}">
    {!! Form::label('sell_price', 'Sell price', ['class' => 'control-label']) !!}
    {!! Form::text('sell_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('sell_price', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.units_in_stock.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('units_in_stock') ? 'has-error' : ''}}">
    {!! Form::label('units_in_stock', 'Units in stock', ['class' => 'control-label']) !!}
    {!! Form::text('units_in_stock', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('units_in_stock', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.note.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    {!! Form::label('note', 'Note', ['class' => 'control-label']) !!}
    {!! Form::text('note', null, ['class' => 'form-control']) !!}
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>
@endif

@if((auth()->user()->can('product.description.edit') && $formMode === 'edit') || $formMode === 'create')
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
@endif



<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
