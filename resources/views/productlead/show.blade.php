@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">                                                                           
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">productlead {{ $productlead->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/productleads/productlead') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/productleads/productlead/' . $productlead->id . '/edit') }}" title="Edit productlead"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['productleads/productlead', $productlead->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete productlead',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $productlead->id }}</td>
                                    </tr>
                                    <tr><th> Counter </th><td> {{ $productlead->counter }} </td></tr><tr><th> Status 0 </th><td> {{ $productlead->status_0 }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
