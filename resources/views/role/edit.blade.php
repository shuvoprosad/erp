@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit role #{{ $role->id }}</div>
                    <div class="card-body">
                        <br />

                        {!! Form::model($role, [
                            'method' => 'PATCH',
                            'route' => ['roles.update', $role->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('role.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="{{ asset('assets/libs/switchery/switchery.min.js')}}"></script>
@endsection

@section('javascript_end')
@endsection