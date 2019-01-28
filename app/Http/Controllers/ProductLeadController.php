<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductLeadController extends Controller
{
    public function get_status(){
        $status = array("accepted"=>"accepted", "rejected"=>"rejected", "pending"=>"pending");
        
        return $status;
    }

    public function get_customer(){
        $customers = Customer::select('id','name')->get();
        $data = array();
        foreach ($customers as $customer) {
            $data[$customer->id] = $customer->name;
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        if (request()->ajax()|| 1==0) 
        {
            $orders = Order::with('customer','agent')->select('orders.*')->whereNotIn('status_0', ['accepted',]);
            
            return datatables()
            ->of($orders)
            ->addColumn('action',
                function ($orders) {
                    $html ='<a href="' . route('productleads.edit', ['id'=>$orders->id]) . '" class="btn btn-primary waves-effect waves-light"> <i class="far fa-edit "></i> edit </a>';
                    $html .='<a href="' . route('productleads.destroy', ['id'=>$orders->id]) . '" class="btn btn-danger waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i> delete  </a>';
                    return $html;
                }
            )
            ->filter(function ($query) use ($request) {
                if ($request->has('from') && $request->has('to')) {
                    $start = date("Y-m-d",strtotime($request->input('from')));
                    $end = date("Y-m-d",strtotime($request->input('to')."+1 day"));
                    $query->whereBetween('orders.created_at',[$start,$end]);
                }
            })
            ->make(true);
        }

        return view('productlead.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $status = $this->get_status();
        $customer = $this->get_customer();
        return view('productlead.create',compact('status','customer'));
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

        return view('productlead.index')->with('flash_message', 'Order added!');
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

        return view('productlead.show', compact('productlead'));
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
        $status = $this->get_status();
        $customer = $this->get_customer();
        $productlead = Order::findOrFail($id);

        return view('productlead.edit', compact('productlead','status','customer'));
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
        
        $requestData = $request->all();
        
        $order = Order::findOrFail($id);
        $order->customer_id = $request->customer_id;
        $order->counter = $request->counter;
        $order->status_0 = $request->status_0;
        $order->save();

        return view('productlead.index')->with('flash_message', 'Order updated!');
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

        return view('productlead.index')->with('flash_message', 'Order deleted!');
    }

}
