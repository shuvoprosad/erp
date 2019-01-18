<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Salary;
use App\User;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function get_user(){
        $users = User::select('id','name')->get();
        $data = array();
        foreach ($users as $user) {
            $data[$user->id] = $user->name;
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
        //$products = Salary::select(['id', 'name', 'price', 'available']);
        
        if (request()->ajax()|| 1==9) 
        {
            $salaries = Salary::with('user')->select('salaries.*');
            
            return datatables()
            ->of($salaries)
            ->addColumn('action',
                function ($salaries) {
                    $html ='<a href="' . route('salaries.edit', ['id'=>$salaries->id]) . '" class="btn btn-primary btn-rounded waves-effect waves-light"> <i class="glyphicon glyphicon-edit"></i> edit </a>';
                    $html .='<a href="' . route('salaries.destroy', ['id'=>$salaries->id]) . '" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i> delete  </a>';
                    return $html;
                }
            )
            ->make(true);
        }
        return view('salary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = $this->get_user();
        return view('salary.create',compact('users'));
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
        $salary = new Salary;
        $salary->user_id = $request->user_id;
        $salary->work_days = $request->work_days;
        $salary->over_days = $request->over_days;
        $salary->total_sales = $request->total_sales;
        $salary->comission_percent = $request->comission_percent;
        $salary->comission = ($salary->total_sales > 0 && isset($salary->total_sales)) ? ($request->total_sales / 100)*comission_percent : 0;
        $salary->bonus = $request->bonus;
        $salary->gross_salary = $request->gross_salary;
        $salary->advance = $request->advance;
        $total_salary = (($salary->gross_salary / $salary->work_days) * $salary->work_days) + (($salary->gross_salary/30) * $salary->over_days) + $salary->comission + $salary->bonus;
        $salary->total_salary = round($total_salary, 0, PHP_ROUND_HALF_DOWN);
        $salary->to_be_paid = $salary->total_salary - $salary->advance;
        $salary->save();

        return view('salary.index')->with('flash_message', 'Salary added!');
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
        $salary = Salary::with('user')->findOrFail($id);

        return view('salary.show', compact('salary'));
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
        $salary = Salary::with('user')->findOrFail($id);
        $users = $this->get_user();

        return view('salary.edit', compact('salary','users'));
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
        $request->validate([
            'user_id' => 'required|integer',
            'work_days' => 'required|integer',
        ]);
        
        $salary = Salary::findOrFail($id);
        $salary->user_id = $request->user_id;
        $salary->work_days = $request->work_days;
        $salary->over_days = $request->over_days;
        $salary->total_sales = $request->total_sales;
        $salary->comission_percent = $request->comission_percent;
        $salary->comission = ($salary->total_sales > 0 && isset($salary->total_sales)) ? ($request->total_sales / 100)*comission_percent : 0;
        $salary->bonus = $request->bonus;
        $salary->gross_salary = $request->gross_salary;
        $salary->advance = $request->advance;
        $total_salary = (($salary->gross_salary / $salary->work_days) * $salary->work_days) + (($salary->gross_salary/30) * $salary->over_days) + $salary->comission + $salary->bonus;
        $salary->total_salary = round($total_salary, 0, PHP_ROUND_HALF_DOWN);
        $salary->to_be_paid = $salary->total_salary - $salary->advance;
        $salary->save();

        return view('salary.index')->with('flash_message', 'Salary updated!');
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
        Salary::destroy($id);

        return view('salary.index')->with('flash_message', 'Salary deleted!');
    }
}
