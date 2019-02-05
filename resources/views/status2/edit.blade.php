@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit status 2 #{{ $status2->id }}</div>
                    <div class="card-body">
                        <br />
                        {!! Form::model($status2, [
                            'method' => 'PATCH',
                            'route' => ['status2.update', $status2->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('status2.form', ['formMode' => 'edit'])

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