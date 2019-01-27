<div class="form-group {{ $errors->has('roles') ? 'has-error' : ''}}">
    {!! Form::label('roles', 'Role', ['class' => 'control-label']) !!}
    {!! Form::select('roles[]', $roles, isset($oldRoles)?$oldRoles:null, ['class' => 'form-control', 'id' => 'roles', 'data-toggle'=>'select2', 'multiple'] ) !!}
    {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
</div>

@can('user.name.edit')
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.email.edit')
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.password.edit')
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.mobile.edit')
<div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
    {!! Form::label('mobile', 'Mobile', ['class' => 'control-label']) !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
    {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.address.edit')
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.image.edit')
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
@endcan

@can('user.type.edit')
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
@endcan

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
