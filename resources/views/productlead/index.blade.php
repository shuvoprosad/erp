@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <a  href="{{ route('productleads.create') }}" class="btn btn-success btn-rounded waves-effect waves-light">Create lead</a>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Customer name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Agent name</th>
                                <th>Status_0</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Customer name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Agent name</th>
                                <th>Status_0</th>
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
        ajax: '{{ route('productleads.index') }}',
        columns: [
                { data: 'id', name: 'orders.id' },
                { data: 'customer.name', name: 'customer.name' },
                { data: 'customer.phone', name: 'customer.phone' },
                { data: 'customer.address', name: 'customer.address' },
                { data: 'agent.name', name: 'agent.name' },
                { data: 'status_0', name: 'orders.status_0' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        initComplete: function () {
            this.api().columns([1,2,3]).every(function () {
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

@section('css')

@endsection