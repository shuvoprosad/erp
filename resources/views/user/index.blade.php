@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <a  href="{{ route('users.create') }}" class="btn btn-success btn-rounded waves-effect waves-light">Create user</a>
                    <table class="table " id="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Type</th>
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
        ajax: '{{ route('users.index') }}',
        columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'mobile', name: 'mobile' },
                { data: 'address', name: 'address' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        initComplete: function () {
            this.api().columns([1,2,3,4,5]).every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.header()).empty())
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
    <style>
        .btn.btn-success.btn-rounded.waves-effect.waves-light {
            width: 100px;
        }
    </style>
@endsection