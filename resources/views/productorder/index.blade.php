@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer name</th>
                                <th>Customer num</th>
                                <th>Customer address</th>
                                <th>Payment type</th>
                                <th>Payment num</th>
                                <th>Paid amount</th>
                                <th>Shipped by</th>
                                <th>Shipping method</th>
                                <th>Status 1</th>
                                <th>Status 1 date</th>
                                <th>Status 2</th>
                                <th>Status 2 date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Customer name</th>
                                <th>Customer num</th>
                                <th>Customer address</th>
                                <th>Payment type</th>
                                <th>Payment num</th>
                                <th>Paid amount</th>
                                <th>Shipped by</th>
                                <th>Shipping method</th>
                                <th>Status 1</th>
                                <th>Status 1 date</th>
                                <th>Status 2</th>
                                <th>Status 2 date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
@endsection

@section('javascript')
<script>
    $(function() {
    $('#table').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        responsive: false,
        ajax: '{{ route('productorders.index') }}',
        columns: [
                { data: 'id', name: 'orders.id' },
                { data: 'customer.name', name: 'customer.name' },
                { data: 'customer.phone', name: 'customer.phone' },
                { data: 'customer.address', name: 'customer.address' },
                { data: 'payment_type', name: 'orders.payment_type' },
                { data: 'Payment_number', name: 'orders.Payment_number' },
                { data: 'Paid_amount', name: 'orders.Paid_amount' },
                { data: 'shipped_by.name', name: 'shipped_by.name' },
                { data: 'shipping_method', name: 'orders.shipping_method' },
                { data: 'status_1', name: 'orders.status_1' },
                { data: 'date_status_1', name: 'orders.date_status_1' },
                { data: 'status_2', name: 'orders.status_2' },
                { data: 'date_status_2', name: 'orders.date_status_2' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        initComplete: function () {
            this.api().columns([1,2,3,4,5,6,7,8,9,10,11]).every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
});

</script>
@endsection
