@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit status 0 #{{ $status0->id }}</div>
                    <div class="card-body">
                        <br />
                        {!! Form::model($status0, [
                            'method' => 'PATCH',
                            'route' => ['status0.update', $status0->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('status0.form', ['formMode' => 'edit'])

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