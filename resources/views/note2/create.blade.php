@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create note 2</div>
                    <div class="card-body">
                        <br />
                        {!! Form::open(['route' => 'note2.store', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('note2.form', ['formMode' => 'create'])

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