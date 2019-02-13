@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('productorders.create') }}" class="btn btn-success waves-effect waves-light"> <i class="fa fa-"></i> Create order  </a>
                    </div>
                </div>
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
                            <th>Agent name</th>
                            <th>Customer name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Extension</th>
                            <th>Counter</th>
                            <th>Shipped by</th>
                            <th>Shipping method</th>
                            <th>Status 1</th>
                            <th>Status 2</th>
                            <th>Last balance</th>
                            <th>Last number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Extension</th>
                            <th>Counter</th>
                            <th>Shipped by</th>
                            <th>Shipping method</th>
                            <th>Status 1</th>
                            <th>Status 2</th>
                            <th>Last balance</th>
                            <th>Last number</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row" id="export"></div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div><!-- end row-->
@endsection

@section('javascript')
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('javascript_end')
<script>
$(function() {
    $.fn.dataTable.ext.errMode = 'none';
    $('#table').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        if(title == "Id" || title == "Action"){
        }else{
            $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
        }
    } );

    var oTable = $('#table').DataTable({
        processing: false,
        serverSide: true,
        scrollX: true,
        responsive: false,
        fixedHeader: true,
        ajax: 
        {
            url:'{{ route('productorders.index') }}',
            data: function (d) {
                d.from = $('input[name=from]').val();
                d.to = $('input[name=to]').val();
            }
        },
        columns: 
        [
            { data: 'id', name: 'orders.id' },
            { data: 'agent.name', name: 'agent.name' },
            { data: 'customer.name', name: 'customer.name' },
            { data: 'customer.mobile', name: 'customer.mobile' },
            { data: 'customer.address', name: 'customer.address' },
            { data: 'customer.address_extension', name: 'customer.address_extension' },
            { data: 'counter', name: 'orders.counter' },
            { data: 'shipped_by.name', name: 'shipped_by.name' },
            { data: 'shipping_method', name: 'orders.shipping_method' },
            { data: 'status_1', name: 'orders.status_1' },
            { data: 'status_2', name: 'orders.status_2' },
            { data: 'last_balance', name: 'orders.last_balance' },
            { data: 'last_number', name: 'orders.last_number' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        dom: 'lfrtipB',
        buttons: 
        [
            'csv', 'excel'
        ],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });

    oTable.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

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
});

</script>
@endsection
