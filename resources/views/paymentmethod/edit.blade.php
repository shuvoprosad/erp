@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit payment method #{{ $paymentmethod->id }}</div>
                    <div class="card-body">
                        <br />
                        {!! Form::model($paymentmethod, [
                            'method' => 'PATCH',
                            'route' => ['paymentmethod.update', $paymentmethod->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('paymentmethod.form', ['formMode' => 'edit'])

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