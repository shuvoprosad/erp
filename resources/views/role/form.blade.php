<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
@foreach ($permissions as $key => $permission)
<div class="custom-control custom-checkbox {{ $errors->has('permissions') ? 'has-error' : ''}}">
    {!! Form::checkbox('permissions[]', $permission, isset($role)?(in_array($permission, $role->permissions->pluck('name')->toArray())?true:null):null, ['class' => 'custom-control-input', 'id' => $permission] ) !!}
    {!! Form::label($permission, $permission, ['class' => 'custom-control-label h5']) !!}
    {!! $errors->first('permissions', '<p class="help-block">:message</p>') !!}
</div>
@endforeach

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
