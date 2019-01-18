<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Status 0', ['class' => 'control-label']) !!}
    {!! Form::select('user_id',$users , old('users')??isset($salary)?$salary->user->id:null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('work_days') ? 'has-error' : ''}}">
    {!! Form::label('work_days', 'Work days', ['class' => 'control-label']) !!}
    {!! Form::text('work_days', null, ['class' => 'form-control', 'required' => 'required', 'data-parsley-type' => 'integer'] ) !!}
    {!! $errors->first('work_days', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('over_days') ? 'has-error' : ''}}">
    {!! Form::label('over_days', 'Over days', ['class' => 'control-label']) !!}
    {!! Form::text('over_days', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('over_days', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('gross_salary') ? 'has-error' : ''}}">
    {!! Form::label('gross_salary', 'Gross salary', ['class' => 'control-label']) !!}
    {!! Form::text('gross_salary', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('gross_salary', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('comission_percent') ? 'has-error' : ''}}">
    {!! Form::label('comission_percent', 'Comission percentage', ['class' => 'control-label']) !!}
    {!! Form::text('comission_percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('comission_percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bonus') ? 'has-error' : ''}}">
    {!! Form::label('bonus', 'Bonus', ['class' => 'control-label']) !!}
    {!! Form::text('bonus', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('bonus', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
