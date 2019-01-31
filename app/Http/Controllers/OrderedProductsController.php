<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProducts;

class OrderedProductsController extends Controller
{
    public function get_all_payment_types(){
        $array = array("Bkash"=>"Bkash", "FlexiLoad"=>"FlexiLoad", "Rocket"=>"Rocket");
        return $array;
    }

    public function get_all_payment_numbers(){
        $array = array("01740050057"=>"01740050057", "01740050067"=>"01740050067", "01712312345"=>"01712312345");
        return $array;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $order_id = $request->order_id;

        $payments = OrderProducts::with('')->where('order_id',$order_id)->get();

        return view('payment.index', compact('payments','order_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $order_id = $request->order_id;
        $payment_type = $this->get_all_payment_types();
        $Payment_number = $this->get_all_payment_numbers();
        return view('payment.create',compact('payment_type','Payment_number','order_id'));
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
        $payment = new Payment;
        $payment->order_id = $request->order_id;
        $payment->payment_type = $request->payment_type;
        $payment->Payment_number = $request->Payment_number;
        $payment->Paid_amount = $request->Paid_amount;
        $payment->save();
        return redirect()->route('payments.index', ['id' => $payment->order_id])->with('flash_message', 'payments added!');
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
        $payment = Payment::findOrFail($id);
        $payment_type = $this->get_all_payment_types();
        $Payment_number = $this->get_all_payment_numbers();
        return view('payment.edit', compact('payment','payment_type','Payment_number'));
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
        $payment = Payment::findOrFail($id);
        $payment->payment_type = $request->payment_type;
        $payment->Payment_number = $request->Payment_number;
        $payment->Paid_amount = $request->Paid_amount;
        $payment->save();

        return redirect()->route('payments.index', ['id' => $payment->order_id])->with('flash_message', 'Permission updated!');
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
        Payment::destroy($id);

        return redirect('payments')->with('flash_message', 'Permission deleted!');
    }
}
