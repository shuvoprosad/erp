@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

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
                            <div class="alert alert-warning fade show">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
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
    <script src="{{ asset('assets/libs/select2/select2.min.js')}}"></script>
@endsection

@section('javascript_end')
    <script>
        $(document).ready(function () {
            $(".form-horizontal").parsley()
        });
        $(document).ready(function() {
            $('#user_id').select2();
        });
    </script>
@endsection
