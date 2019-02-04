@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit role #{{ $paymentnumber->id }}</div>
                    <div class="card-body">
                        <br />
                        {!! Form::model($paymentnumber, [
                            'method' => 'PATCH',
                            'route' => ['paymentnumber.update', $paymentnumber->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('paymentnumber.form', ['formMode' => 'edit'])

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