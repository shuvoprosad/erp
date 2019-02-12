<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:product.create', ['only' => ['create','store']]);

        $this->middleware('permission:product.edit', ['only' => ['edit','update']]);

        $this->middleware('permission:product.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        //$products = Product::select(['id', 'name', 'price', 'available']);
        
        if (request()->ajax()|| 1==2) 
        {
            $products = Product::with('product_type')->select('products.*');
            //dd($products);
            
            return datatables()
            ->of($products)
            ->addColumn('action',
                function ($products) {
                    $html ='<a href="' . route('products.edit', ['id'=>$products->id]) . '" class="btn btn-primary waves-effect waves-light"> <i class="glyphicon glyphicon-edit"></i> edit </a>';
                    $html .='<a href="' . route('products.destroy', ['id'=>$products->id]) . '" class="btn btn-danger waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i> delete  </a>';
                    return $html;
                }
            )
            ->make(true);
        }
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('product.create');
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
        
        Product::create($requestData);

        return view('product.index')->with('flash_message', 'Product added!');
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
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
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
        $product = Product::findOrFail($id);
        $productTypes = $this->get_product_types();

        return view('product.edit', compact('product','productTypes'));
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
        $product = Product::findOrFail($id);
        if(!is_null($request->type))
        $product->type = $request->type;

        if(!is_null($request->name))
        $product->name = $request->name;

        if(!is_null($request->description))
        $product->description = $request->description;

        if(!is_null($request->sku))
        $product->sku = $request->sku;

        if(!is_null($request->buy_price))
        $product->buy_price = $request->buy_price;

        if(!is_null($request->sell_price))
        $product->sell_price = $request->sell_price;

        if(!is_null($request->units_in_stock))
        $product->units_in_stock = $request->units_in_stock;

        if(!is_null($request->note))
        $product->note = $request->note;
        $product->save();
        return view('product.index')->with('flash_message', 'Product updated!');
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
        Product::destroy($id);

        return view('product.index')->with('flash_message', 'Product deleted!');
    }

    public function get_product_types()
    {
        $types = ProductType::select('id','name')->get();
        $data = array();
        foreach ($types as $type) {
            $data[$type->id] = $type->name;
        }
        return $data;
    }

    public function search($query)
    {
        $items = Product::where('name','LIKE',$query.'%')->select('id','name','sell_price')->get();
        return $items->toJson();
    }
}
