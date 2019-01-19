@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('salaries.create') }}" class="btn btn-success btn-rounded waves-effect waves-light">Create salary</a>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User name</th>
                            <th>Work days</th>
                            <th>Over days</th>
                            <th>Total sales</th>
                            <th>Comission</th>
                            <th>Bonus</th>
                            <th>Gross salary</th>
                            <th>Total salary</th>
                            <th>Advance</th>
                            <th>To be paid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User name</th>
                            <th>Work days</th>
                            <th>Over days</th>
                            <th>Total sales</th>
                            <th>Comission</th>
                            <th>Bonus</th>
                            <th>Gross salary</th>
                            <th>Total salary</th>
                            <th>Advance</th>
                            <th>To be paid</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- end card body-->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-->
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
        ajax: '{{ route('salaries.index') }}',
        columns: [
                { data: 'id', name: 'id' },
                { data: 'user.name', name: 'user.name' },
                { data: 'work_days', name: 'work_days' },
                { data: 'over_days', name: 'over_days' },
                { data: 'total_sales', name: 'total_sales' },
                { data: 'comission', name: 'comission' },
                { data: 'bonus', name: 'bonus' },
                { data: 'gross_salary', name: 'gross_salary' },
                { data: 'total_salary', name: 'total_salary' },
                { data: 'advance', name: 'advance' },
                { data: 'to_be_paid', name: 'to_be_paid' },
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