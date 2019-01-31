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
                    <a  href="{{ route('products.create') }}" class="btn btn-primary waves-effect waves-light">Create product</a>
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                @can('product.type.view')
                                <th>Type</th>
                                @endcan
                                @can('product.name.view')
                                <th>Name</th>
                                @endcan
                                @can('product.buy_price.view')
                                <th>Buying price</th>
                                @endcan
                                @can('product.sell_price.view')
                                <th>Selling price</th>
                                @endcan
                                @can('product.units_in_stock.view')
                                <th>Units in stock</th>
                                @endcan
                                @can('product.units_in_shipping.view')
                                <th>Units in shipping</th>
                                @endcan
                                @can('product.description.view')
                                <th>Description</th>
                                @endcan
                                @can('product.note.view')
                                <th>Note</th>
                                @endcan
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                @can('product.type.view')
                                <th>Type</th>
                                @endcan
                                @can('product.name.view')
                                <th>Name</th>
                                @endcan
                                @can('product.buy_price.view')
                                <th>Buying price</th>
                                @endcan
                                @can('product.sell_price.view')
                                <th>Selling price</th>
                                @endcan
                                @can('product.units_in_stock.view')
                                <th>Units in stock</th>
                                @endcan
                                @can('product.units_in_shipping.view')
                                <th>Units in shipping</th>
                                @endcan
                                @can('product.description.view')
                                <th>Description</th>
                                @endcan
                                @can('product.note.view')
                                <th>Note</th>
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
        if(title == "Id" || title == "Action"){
        
        }else{
            $(this).html( '<input type="text" class="form-control" placeholder="'+title+'" />' );
        }
    } );

    var oTable = $('#table').DataTable
    ({
        processing: false,
        serverSide: true,
        scrollX: true,
        ajax: '{{ route('products.index') }}',
        columns: 
        [
            { data: 'id', name: 'products.id' },
            @can('product.type.view')
            { data: 'product_type.name', name: 'product_type.name' },
            @endcan
            @can('product.name.view')
            { data: 'name', name: 'products.name' },
            @endcan
            @can('product.buy_price.view')
            { data: 'buy_price', name: 'products.buy_price' },
            @endcan
            @can('product.sell_price.view')
            { data: 'sell_price', name: 'products.sell_price' },
            @endcan
            @can('product.units_in_stock.view')
            { data: 'units_in_stock', name: 'products.units_in_stock' },
            @endcan
            @can('product.units_in_shipping.view')
            { data: 'units_in_shipping', name: 'products.units_in_shipping' },
            @endcan
            @can('product.description.view')
            { data: 'description', name: 'products.description' },
            @endcan
            @can('product.note.view')
            { data: 'note', name: 'products.note' },
            @endcan
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],

        drawCallback: function () 
        {
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
});

</script>
@endsection
