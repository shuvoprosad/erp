@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New payment</div>
                    <div class="card-body">
                        <a href="{{ route('payments.index',['order_id'=>$order_id]) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['route' => ['payments.store',$order_id], 'class' => 'form-horizontal', 'files' => true]) !!}
                        
                        @include ('payment.form', ['formMode' => 'create'])
                        
                        {!! Form::close() !!}

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
