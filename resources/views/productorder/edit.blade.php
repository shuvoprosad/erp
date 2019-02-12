@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/searchproduct.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit productlead #{{ $productorder->id }}</div>
                    <div class="card-body">
                        <br />

                        {!! Form::model($productorder, [
                            'method' => 'PATCH',
                            'route' => ['productorders.update', $productorder->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('productorder.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary','id' => 'submit']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{ asset('assets/libs/autocomplete/jquery.autocomplete.min.js')}}"></script>
@endsection

@section('javascript_end')
<script>
    $(document).ready(function() 
    {
        $('#customer_address').select2(
        {
            minimumResultsForSearch: Infinity
        });
    });

    $('input[name=date]').flatpickr(
    {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        defaultDate: "{{(isset($productorder))?$productorder->date:''}}"
    });

    $('#customer_mobile').keyup(function()
    { 
        let query = $(this).val();
        let url = "{{ route('customers.search',['query'=>'']) }}"+"/"+query;
        console.log(url);
        if(query.length > 10)
        {
            console.log(query);
            $.ajax({
                url:url,
                method:"GET",
                data:
                {
                    query:query
                },
                success:function(data)
                {
                    var obj = jQuery.parseJSON(data);
                    $("#customer_name").val(obj.name); 
                    if ($('#customer_address').find("option[value='" + obj.address + "']").length) 
                    {
                        $('#customer_address').val(obj.address).trigger('change');
                    } 
                    else 
                    { 
                        // Create a DOM Option and pre-select by default
                        var newOption = new Option(obj.address, obj.address, true, true);
                        // Append it to the select
                        $('#customer_address').append(newOption).trigger('change');
                    } 
                    $("#customer_address_extension").val(obj.address_extension);
                },
                error: function (xhr) 
                {
                    console.log("error");
                }
            });
        }
    }); 

    $('#payment_method').change(function()
    {
        console.log('ok');
        let query = $(this).val();
        let url = "{{ route('paymentnumber.search',['query'=>'']) }}"+"/"+query;
        $.ajax({
            url:url,
            method:"GET",
            data:{query:query},
            success:function(data)
            {
                let items = jQuery.parseJSON(data);
                $('#payment_number').empty();
                $.each(items, function(index, obj)
                {
                    $('#payment_number').append('<option value="'+ obj.id +'">'+ obj.mobile +'</option>');
                })
            }
        });
    });



    //

    $("#search_products").keyup(function(){
        let query = $(this).val();
        let url = "{{ route('products.search',['query'=>'']) }}"+"/"+query;
		$.ajax({
            type: "GET",
            url: url,
            data:{query:query},
            success: function(data){
                let items = jQuery.parseJSON(data);
                $('table').empty();
                $("#suggesstion-box").show();
                
                let html = '';
                $.each(items, function(index, obj)
                {
                    html+='<tr><td class="id">'+ obj.id+'</td><td class="name">'+obj.name+'</td><td class="price">'+obj.sell_price +'</td></tr>';
                })
                $("table").html(html);
                //$("#search-box").css("background","#FFF");
            }
		});
	});

    $('table').on('click', 'tr', function(event){
        let id = $(this).closest('tr').find('.id').text();
        let name = $(this).closest('tr').find('.name').text();
        let price = $(this).closest('tr').find('.price').text();
        console.log(name+price+id);
        addItemToCart( name, price, id);
        updateCartTotal();
        $('table').empty();
        $('#suggesstion-box').hide();
    });

    $('#condition_amount').keyup(function(){
        let conditionAmount = $(this).val();
        let totalAmount = parseInt($('.cart-total-price').text());
        console.log(totalAmount);
        $("#receivable_amount").val(totalAmount-conditionAmount);
    });
// submit 
$("#submit").click(function(){
        let form_data = $('.form-horizontal').serializeArray();
        var cartItemContainer = document.getElementsByClassName('cart-items')[0];
        var cartItems = cartItemContainer.getElementsByClassName('cart-row');
        let products_id = [];
        let products_quantity = [];
        for (let i = 0; i < cartItems.length; i++) {
            let id = cartItems[i].getElementsByClassName('cart-item-id')[0].innerText;
            let quantity = cartItems[i].getElementsByClassName('cart-quantity-input')[0].value;
            products_id.push(id);
            products_quantity.push(quantity);
        }
        form_data.push({name: 'products_id', value: products_id});
        form_data.push({name: 'products_quantity', value: products_quantity});
        console.log(form_data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"{{ route('productorders.update', $productorder->id)}}",
                data : form_data,
                traditional: true,
                success: function(data) {
                    console.log(data);
                    if(data.success == 1){
					alert(data.msg);
				    } else {
                        console.log(data);
					    alert("Something went wrong");
				    }
                }
            });
            
    }); 
    //or code

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    updateCartTotal();
    //document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}

function purchaseClicked() {
    alert('Thank you for your purchase')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateCartTotal()
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    addItemToCart(title, price, imageSrc)
    updateCartTotal()
}

function addItemToCart(title, price, id) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == title) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-id cart-column">
            <span class="cart-item-id">${id}</span>
        </div>
        <div class="cart-item cart-column">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <button class="btn btn-danger" type="button">REMOVE</button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = '' + total
}
</script>
@endsection
