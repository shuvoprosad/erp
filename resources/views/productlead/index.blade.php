@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('productleads.create') }}" class="btn btn-success btn-rounded waves-effect waves-light">Create lead</a>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>From</label>
                            <input name="from" class="form-control flatpickr-input" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>To</label>
                            <input name="to" class="form-control flatpickr-input" type="text">
                        </div>
                    </div>
                </div>
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
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('javascript_end')
<script>
$(function() {
    var oTable = $('#table').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: {
            url:'{{ route('productleads.index') }}',
            data: function (d) {
                d.from = $('input[name=from]').val();
                d.to = $('input[name=to]').val();
            }
        },
        columns: [
                { data: 'id', name: 'orders.id' },
                { data: 'customer.name', name: 'customer.name' },
                { data: 'customer.mobile', name: 'customer.mobile' },
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

$('input[name=from]').flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    onClose: function(selectedDates, dateStr, instance){
        oTable.draw();
    }
});

$('input[name=to]').flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    onClose: function(selectedDates, dateStr, instance){
        oTable.draw();
    }
});

  $("#datepicker_to").datepicker({
    showOn: "button",
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      oTable.draw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    oTable.draw();
  });

});
</script>
@endsection