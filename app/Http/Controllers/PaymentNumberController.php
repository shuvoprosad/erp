<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentNumbers;
use App\PaymentMethod;

class PaymentNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 25;

        $paymentnumbers = PaymentNumbers::with('paymentmethod')->latest()->paginate($perPage);


        return view('paymentnumber.index', compact('paymentnumbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $paymentmethods = $this->get_paymentmethods();
        return view('paymentnumber.create',compact('paymentmethods'));
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
        
        $requestData = $request->all();
        PaymentNumbers::create($requestData);

        return redirect('paymentnumber')->with('flash_message', 'Role added!');
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
        $paymentnumber = PaymentNumbers::findOrFail($id);
        $paymentmethods = $this->get_paymentmethods();
        return view('paymentnumber.edit', compact('paymentnumber','paymentmethods'));
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
        
        $paymenttype = PaymentNumbers::findOrFail($id);
        $paymenttype->update($requestData);

        return redirect('paymentnumber')->with('flash_message', 'Role updated!');
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
        PaymentNumbers::destroy($id);

        return redirect('paymentnumber')->with('flash_message', 'Role deleted!');
    }

    public function get_paymentmethods()
    {
        $items = PaymentMethod::select('id','name')->get();
        $data = array();
        foreach ($items as $item) {
            $data[$item->id] = $item->name;
        }
        return $data;
    }

    public function get_payment_numbers($query)
    {
        $items = PaymentNumbers::where('payment_method_id',$query)->select('id','mobile')->get();
        return $items->toJson();
    }
}
