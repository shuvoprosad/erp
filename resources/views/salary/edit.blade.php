@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit product #{{ $salary->id }}</div>
                    <div class="card-body">
                        <a href="{{ route('salaries.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($salary, [
                            'method' => 'PATCH',
                            'route' => ['salaries.update', $salary->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('salary.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
@endsection

@section('javascript_end')
    <script>
        $(document).ready(function () {
            $(".form-horizontal").parsley()
        });
    </script>
@endsection
