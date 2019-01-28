@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Payments</div>
                    <div class="card-body">
                        <a href="{{ route('payments.create',['order_id'=>$order_id]) }}" class="btn btn-success btn-sm" title="Add New permission">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order id</th>
                                        <th>Payment type</th>
                                        <th>Payment number</th>
                                        <th>Paid amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $item)
                                    <tr>
                                        <td>{{ $item->order_id }}</td>
                                        <td>{{ $item->payment_type }}</td>
                                        <td>{{ $item->Payment_number }}</td>
                                        <td>{{ $item->Paid_amount }}</td>
                                        <td>
                                            <a href="{{ route('payments.edit',$item->id) }}" title="Edit permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ route('payments.destroy',$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete permission" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
