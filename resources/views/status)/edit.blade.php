@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit role #{{ $address->id }}</div>
                    <div class="card-body">
                    <br />

                        {!! Form::model($address, [
                            'method' => 'PATCH',
                            'route' => ['address.update', $address->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('district.form', ['formMode' => 'edit'])

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