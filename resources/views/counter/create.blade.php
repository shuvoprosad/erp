@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create counter</div>
                    <div class="card-body">
                        <br />

                        {!! Form::open(['route' => 'counter.store', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('district.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="{{ asset('assets/libs/select2/select2.min.js')}}"></script>
@endsection

@section('javascript_end')
<script>
    $(document).ready(function() {
        $('#permissions').select2();
    });
</script>
@endsection