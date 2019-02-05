<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Customer;
use App\User;
use App\District;
use App\Status0;
use App\Status1;
use App\Status2;
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
                $html ='<a href="' . route('productorders.edit', ['id'=>$orders->id]) . '" class="btn btn-primary waves-effect waves-light"> <i class="far fa-edit "></i> edit </a>';
                $html .='<a href="' . route('payments.index', ['order_id'=>$orders->id]) . '" class="btn btn-success waves-effect waves-light"> <i class=" far fa-money-bill-alt "></i> payment  </a>';
                $html .='<a href="' . route('o_products.index', ['order_id'=>$orders->id]) . '" class="btn btn-success waves-effect waves-light"> <i class=" far fa-money-bill-alt "></i> products  </a>';
                $html .='<a href="' . route('productorders.destroy', ['id'=>$orders->id]) . '" class="btn btn-danger waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i> delete  </a>';
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
        $shipped_by = $this->get_shipped_by();
        $shipping_methods = $this->get_shipping_method();
        $status_0 = $this->get_status_0();
        $status_1 = $this->get_status_1();
        $status_2 = $this->get_status_2();

        return view('productorder.create', compact('addresses','payment_methods','shipped_by','shipping_methods','status_0','status_1','status_2'));
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
        $order->customer_id = $request->customer_id;
        $order->agent_id = Auth::id();
        $order->counter = $request->counter;
        $order->status_0 = $request->status_0;
        $order->save();

        return view('productorder.index')->with('flash_message', 'Order added!');
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
        $payment_type = $this->get_payment_methods();
        $shipped_by = $this->get_shipped_by();
        $shipping_method = $this->get_shipping_method();
        $status_1 = $this->get_status_1();
        $status_2 = $this->get_status_2();
        $productorder = Order::findOrFail($id);

        return view('productorder.edit', compact('productorder','payment_type','shipped_by','shipping_method','status_1','status_2'));
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
        $date = date('Y-m-d H:i:s');  
        
        $requestData = $request->all();
        
        $productlead = Order::findOrFail($id);
        $productlead->shipped_by = $request->shipped_by;
        $productlead->shipping_method = $request->shipping_method;
        $productlead->status_1 = $request->status_1;
        if (strcmp($productlead->status_1, $request->status_1)) {
            $productlead->date_status_1 = $productlead->date_status_1;
        }else {
            $productlead->date_status_1 = $date;
        }
        $productlead->status_2 = $request->status_2;
        if (strcmp($productlead->status_2, $request->status_2)) {
            $productlead->date_status_2 = $productlead->date_status_2;
        }else {
            $productlead->date_status_2 = $date;
        }
        $productlead->save();
        //dd($productlead->status_1);
        
        return view('productorder.index')->with('flash_message', 'Order updated!');
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

    public function get_addresses()
    {
        $data = District::get()->pluck('name','name');
        return $data;

    }

}
