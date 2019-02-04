@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit productlead #{{ $productorder->id }}</div>
                    <div class="card-body">
                        <br />

                        {!! Form::model($productorder, [
                            'method' => 'PATCH',
                            'route' => ['productorders.update', $productorder->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('productorder.form', ['formMode' => 'edit'])

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
        $('#shipped_by').select2();
    });
</script>
@endsection
