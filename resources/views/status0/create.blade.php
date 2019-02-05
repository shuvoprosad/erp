@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create new status 0</div>
                    <div class="card-body">
                        <br />
                        {!! Form::open(['route' => 'status0.store', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('status0.form', ['formMode' => 'create'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection

@section('javascript_end')

@endsection