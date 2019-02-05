@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit note 2 #{{ $note2->id }}</div>
                    <div class="card-body">
                        <br />
                        {!! Form::model($note2, [
                            'method' => 'PATCH',
                            'route' => ['note2.update', $note2->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('note2.form', ['formMode' => 'edit'])

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