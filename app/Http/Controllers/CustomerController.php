<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use DataTables;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $customers = Customer::query(['id', 'name', 'mobile', 'address']);
        
        if (request()->ajax()|| 1==3) 
        {
            return DataTables()
            ::of($customers)
            ->addColumn('action',
                function ($customers) {
                    $html ='<a href="' . route('customers.edit', ['id'=>$customers->id]) . '" class="btn btn-primary btn-rounded waves-effect waves-light"> <i class="glyphicon glyphicon-edit"></i> edit </a>';
                    $html.='<form action="'. route('customers.destroy', ['id'=>$customers->id]) .'" method="POST">
                    '.method_field('DELETE').'
                    '. csrf_field().'
                    <button class="btn btn-danger btn-rounded waves-effect waves-light" onclick="return confirm("Confirm delete?")><i class="fa fa-trash"></i> delete</button>
                    </form>';
                    
                    return $html;
                }
            )
            ->toJson();
        }
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customer.create');
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
        
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->save();

        return view('customer.index')->with('flash_message', 'no added!');
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
        $customer = Customer::findOrFail($id);

        return view('customer.show', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        return view('customer.edit', compact('customer'));
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

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;
        $customer->save();

        return view('customer.index')->with('flash_message', 'no updated!');
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
        Customer::destroy($id);

        return view('customer.index')->with('flash_message', 'no deleted!');
    }
}
