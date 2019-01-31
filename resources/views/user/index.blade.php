@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
                                @can('user.name.view')
                                    <th>Name</th>
                                @endcan
                                @can('user.email.view')
                                    <th>Email</th>
                                @endcan
                                @can('user.mobile.view')
                                    <th>Mobile</th>
                                @endcan
                                @can('user.address.view')
                                    <th>Address</th>
                                @endcan
                                @can('user.type.view')
                                    <th>Type</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                @can('user.name.view')
                                    <th>Name</th>
                                @endcan
                                @can('user.email.view')
                                    <th>Email</th>
                                @endcan
                                @can('user.mobile.view')
                                    <th>Mobile</th>
                                @endcan
                                @can('user.address.view')
                                    <th>Address</th>
                                @endcan
                                @can('user.type.view')
                                    <th>Type</th>
                                @endcan
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
        if(title == "Name" || title == "Email" || title == "Mobile" || title == "Address" || title == "Type"){
            $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
        }
    } );

    let table = $('#table').DataTable
    ({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: '{{ route('users.index') }}',
        columns: 
        [
            { data: 'id', name: 'id' },
            @can('user.name.view')
            { data: 'name', name: 'name' },
            @endcan
            @can('user.email.view')
            { data: 'email', name: 'email' },
            @endcan
            @can('user.mobile.view')
            { data: 'mobile', name: 'mobile' },
            @endcan
            @can('user.address.view')
                { data: 'address', name: 'address' },
            @endcan
            @can('user.type.view')
            { data: 'user_type.name', name: 'user_type.name' },
            @endcan
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        
        drawCallback: function () 
        {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    table.columns().every( function () 
    {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );
});

</script>
@endsection
