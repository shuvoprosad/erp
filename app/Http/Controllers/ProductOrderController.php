<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderProducts;
use App\Customer;
use App\User;
use App\District;
use App\Status0;
use App\Status1;
use App\Status2;
use App\Note2;
use App\PaymentMethod;
use App\PaymentNumbers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductOrderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        if (request()->ajax()|| 1==9) 
        {
            $orders = Order::with('customer','shipped_by')->select('orders.*')->whereIn('status_0', ['accepted',]);
            
            return datatables()
            ->of($orders)
            ->addColumn('action',function ($orders) {
                $html ='<a href="' . route('productorders.edit', ['id'=>$orders->id]) . '" class="btn btn-primary waves-effect waves-light"> <i class="far fa-edit "></i></a>';
                $html .='<a href="' . route('productorders.destroy', ['id'=>$orders->id]) . '" class="btn btn-danger waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i></a>';
                return $html;
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('from') && $request->has('to')) {
                    $start = date("Y-m-d",strtotime($request->input('from')));
                    $end = date("Y-m-d",strtotime($request->input('to')."+1 day"));
                    $query->whereBetween('orders.created_at',[$start,$end]);
                }
            })
            ->make(true);
        }

        return view('productorder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $addresses = $this->get_addresses();
        $payment_methods = $this->get_payment_methods();
        $payment_numbers = $this->get_payment_numbers();
        $shipped_by = $this->get_shipped_by();
        $shipping_methods = $this->get_shipping_method();
        $status_0 = $this->get_status_0();
        $status_1 = $this->get_status_1();
        $status_2 = $this->get_status_2();
        $note_2 = $this->get_note_2();

        return view('productorder.create', compact('addresses','payment_methods','payment_numbers','shipped_by','shipping_methods','status_0','status_1','status_2','note_2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
            $order = new Order;
            $existing_customer = Customer::where('mobile',$request->input('customer_mobile'))->get()->first();
            if(is_null($existing_customer)){
                $customer = new Customer;
                $customer->name = $request->input('customer_name');
                $customer->mobile = $request->input('customer_mobile');
                $customer->address = $request->input('customer_address');
                $customer->address_extension = $request->input('customer_address_extension');
                $customer->save();
                $order->customer_id = $customer->id;
            }else {
                $order->customer_id = $existing_customer->id;
                $existing_customer->name = $request->input('customer_name');
                $existing_customer->mobile = $request->input('customer_mobile');
                $existing_customer->address = $request->input('customer_address');
                $existing_customer->address_extension = $request->input('customer_address_extension');
                $existing_customer->save();
            }
            $order->agent_id = $request->input('agent_id');
            $order->date = $request->input('date');
            $order->counter = $request->input('counter');
            $order->offer_price = $request->input('offer_price');
            $order->status_0 = $request->input('status_0');
            $order->note_1 = $request->input('note_1');
            $order->shipped_by = $request->input('shipped_by');
            $order->shipping_method = $request->input('shipping_method');
            $order->last_balance = $request->input('last_balance');
            $order->condition_amount = $request->input('condition_amount');
            $order->receivable_amount = $request->input('receivable_amount');
            $order->last_number = $request->input('last_number');
            $order->cn = $request->input('cn');
            $order->status_1 = $request->input('status_1');
            $order->status_2 = $request->input('status_2');
            $order->note_2 = $request->input('note_2');
            $order->note_extension = $request->input('note_extension');
            $order->save();
            
            $products_id = $request->products_id;
            $products_quantity = $request->products_quantity;
            $id_array;
            preg_match_all('!\d+!', $products_id, $id_array);
            $q_array;
            preg_match_all('!\d+!', $products_quantity, $q_array);
            for($i = 0; $i < count($id_array); $i++) {
                $obj = new OrderProducts;
                $obj->order_id = $order->id;
                $obj->product_id = $id_array[0][$i];
                $obj->quantity = $q_array[0][$i];
                $obj->save();
            }

        $output = ['success' => 1,
                    'msg' => "Order placed"];
        
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $productlead = Order::findOrFail($id);

        return view('productorder.show', compact('productlead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $addresses = $this->get_addresses();
        $payment_methods = $this->get_payment_methods();
        $payment_numbers = $this->get_payment_numbers();
        $shipped_by = $this->get_shipped_by();
        $shipping_methods = $this->get_shipping_method();
        $status_0 = $this->get_status_0();
        $status_1 = $this->get_status_1();
        $status_2 = $this->get_status_2();
        $note_2 = $this->get_note_2();
        $productorder = Order::with('customer','shipped_by','products.product_info')->findOrFail($id);
        //dd($productorder);

        return view('productorder.edit', compact('productorder','addresses','payment_methods','payment_numbers','shipped_by','shipping_methods','status_0','status_1','status_2','note_2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);
            $existing_customer = Customer::where('mobile',$request->input('customer_mobile'))->get()->first();
            if(is_null($existing_customer)){
                $customer = new Customer;
                $customer->name = $request->input('customer_name');
                $customer->mobile = $request->input('customer_mobile');
                $customer->address = $request->input('customer_address');
                $customer->address_extension = $request->input('customer_address_extension');
                $customer->save();
                $order->customer_id = $customer->id;
            }else {
                $order->customer_id = $existing_customer->id;
                $existing_customer->name = $request->input('customer_name');
                $existing_customer->mobile = $request->input('customer_mobile');
                $existing_customer->address = $request->input('customer_address');
                $existing_customer->address_extension = $request->input('customer_address_extension');
                $existing_customer->save();
            }
            $order->agent_id = $request->input('agent_id');
            $order->date = $request->input('date');
            $order->counter = $request->input('counter');
            $order->offer_price = $request->input('offer_price');
            $order->status_0 = $request->input('status_0');
            $order->note_1 = $request->input('note_1');
            $order->shipped_by = $request->input('shipped_by');
            $order->shipping_method = $request->input('shipping_method');
            $order->last_balance = $request->input('last_balance');
            $order->condition_amount = $request->input('condition_amount');
            $order->receivable_amount = $request->input('receivable_amount');
            $order->last_number = $request->input('last_number');
            $order->cn = $request->input('cn');
            $order->status_1 = $request->input('status_1');
            $order->status_2 = $request->input('status_2');
            $order->note_2 = $request->input('note_2');
            $order->note_extension = $request->input('note_extension');
            $order->save();
            
            $old_products_id = OrderProducts::where('order_id', $order->id)->select('id')->get();
            if(!is_null($old_products_id))
            OrderProducts::destroy($old_products_id);

            $products_id = $request->products_id;
            $products_quantity = $request->products_quantity;
            $id_array;
            preg_match_all('!\d+!', $products_id, $id_array);
            $q_array;
            preg_match_all('!\d+!', $products_quantity, $q_array);
            for($i = 0; $i < count($id_array); $i++) {
                $obj = new OrderProducts;
                $obj->order_id = $order->id;
                $obj->product_id = $id_array[0][$i];
                $obj->quantity = $q_array[0][$i];
                $obj->save();
            }

        $output = ['success' => 1,
                    'msg' => "Order placed"];
        
        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return view('productorder.index')->with('flash_message', 'Order deleted!');
    }

    public function get_payment_methods()
    {
        $items = PaymentMethod::select('id','name')->get();
        $data = array();
        foreach ($items as $item) {
            $data[$item->id] = $item->name;
        }
        return $data;
    }

    public function get_payment_numbers()
    {
        $items = PaymentNumbers::select('id','mobile')->get();
        $data = array();
        foreach ($items as $item) {
            $data[$item->id] = $item->mobile;
        }
        return $data;
    }

    
    public function get_shipped_by()
    {
        $customers = User::select('id','name')->get();
        $data = array();
        foreach ($customers as $customer) {
            $data[$customer->id] = $customer->name;
        }
        return $data;
    }

    public function get_customer()
    {
        $customers = User::select('id','name')->get();
        $data = array();
        foreach ($customers as $customer) {
            $data[$customer->id] = $customer->name;
        }
        return $data;
    }

    public function get_shipping_method()
    {
        $data = array("SAP"=>"SAP", "Kortoa"=>"Kortoa", "Pathao"=>"Pathao");
        return $data;
    }

    public function get_status_0()
    {
        $data = Status0::get()->pluck('name','name');
        return $data;
    }

    public function get_status_1()
    {
        $data = Status1::get()->pluck('name','name');
        return $data;
    }

    public function get_status_2()
    {
        $data = Status2::get()->pluck('name','name');
        return $data;
    }

    public function get_note_2()
    {
        $data = Note2::get()->pluck('name','name');
        return $data;
    }

    public function get_addresses()
    {
        $data = District::get()->pluck('name','name');
        return $data;

    }

}
