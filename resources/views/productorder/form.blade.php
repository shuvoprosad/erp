
<div class="form-group">
    <label for="date" class="control-label">Date</label>
    <input id="date" name="date" class="form-control flatpickr-input" type="text">
</div>
<div class="form-group">
    {!! Form::label('agent_id', 'Agent name', ['class' => 'control-label']) !!}
    {!! Form::select('agent_id', $shipped_by, old('agent_id'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>
<div class="form-group">
    {!! Form::label('customer_name', 'Customer name', ['class' => 'control-label']) !!}
    {!! Form::text('customer_name', (isset($productorder->customer))?$productorder->customer->name:null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('customer_mobile', 'Customer mobile', ['class' => 'control-label']) !!}
    {!! Form::text('customer_mobile', (isset($productorder->customer))?$productorder->customer->mobile:null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('customer_address', 'Address', ['class' => 'control-label']) !!}
    {!! Form::select('customer_address', $addresses, (isset($productorder->customer))?$productorder->customer->address:null,['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('customer_address_extension', 'Address extension', ['class' => 'control-label']) !!}
    {!! Form::text('customer_address_extension', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('counter', 'Counter', ['class' => 'control-label']) !!}
    {!! Form::text('counter', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('offer_price', 'Offer price', ['class' => 'control-label']) !!}
    {!! Form::text('offer_price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('note_1', 'Note 1', ['class' => 'control-label']) !!}
    {!! Form::text('note_1', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('status_0', 'Status 0', ['class' => 'control-label']) !!}
    {!! Form::select('status_0', $status_0, old('status_0'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('search_products', 'Search and add products', ['class' => 'control-label']) !!}
        {!! Form::text('search_products', null, ['class' => 'form-control']) !!}
        <div id="suggesstion-box">
            <table>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
    <section class="container content-section">
            
            <div class="cart-row">
                <span class="cart-id cart-column">Id</span>
                <span class="cart-item cart-column">Item</span>
                <span class="cart-price cart-column">Price</span>
                <span class="cart-quantity cart-column">Quantity</span>
            </div>
            <div class="cart-items">
            @if(isset($productorder->products))
                @foreach ($productorder->products as $item)
                <div class="cart-row">
                    <div class="cart-id cart-column">
                        <span class="cart-item-id">{{$item->product_info->id}}</span>
                    </div>
                    <div class="cart-item cart-column">
                        <span class="cart-item-title">{{$item->product_info->name}}</span>
                    </div>
                    <span class="cart-price cart-column">{{$item->product_info->sell_price}}</span>
                    <div class="cart-quantity cart-column">
                        <input class="cart-quantity-input" type="number" value="{{$item->quantity}}">
                        <button class="btn btn-danger" type="button">REMOVE</button>
                    </div>
                </div>    
                @endforeach
            @endif
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">0</span>
            </div>
    </section>
</div>
<div class="form-group">
    {!! Form::label('payment_method', 'Payment method', ['class' => 'control-label']) !!}
    {!! Form::select('payment_method',$payment_methods , old('shipping_method'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('payment_number', 'Payment number', ['class' => 'control-label']) !!}
    {!! Form::select('payment_number', $payment_numbers,old('payment_number'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('condition_amount', 'Condition amount', ['class' => 'control-label']) !!}
    {!! Form::text('condition_amount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('receivable_amount', 'Receivable amount', ['class' => 'control-label']) !!}
    {!! Form::text('receivable_amount', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('shipped_by', 'Shipped by', ['class' => 'control-label']) !!}
    {!! Form::select('shipped_by',$shipped_by , old('shipped_by'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>
<div class="form-group">
    {!! Form::label('shipping_method', 'Shipping method', ['class' => 'control-label']) !!}
    {!! Form::select('shipping_method',$shipping_methods , old('shipping_method'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
        {!! Form::label('cn', 'CN', ['class' => 'control-label']) !!}
        {!! Form::text('cn', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('last_balance', 'Last balance', ['class' => 'control-label']) !!}
        {!! Form::text('last_balance', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('last_number', 'Last number', ['class' => 'control-label']) !!}
        {!! Form::select('last_number', $payment_numbers,old('last_number'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('status_1', 'Status 1', ['class' => 'control-label']) !!}
    {!! Form::select('status_1',$status_1 , old('status_1'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>
<div class="form-group">
    {!! Form::label('status_2', 'Status 2', ['class' => 'control-label']) !!}
    {!! Form::select('status_2',$status_2 , old('status_2'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>
<div class="form-group">
    {!! Form::label('note_2', 'Note 2', ['class' => 'control-label']) !!}
    {!! Form::select('note_2',$note_2 , old('status_2'), ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>
<div class="form-group">
    {!! Form::label('note_extension', 'Note extension', ['class' => 'control-label']) !!}
    {!! Form::text('note_extension', null, ['class' => 'form-control', 'data-toggle'=>'select2']) !!}
</div>


