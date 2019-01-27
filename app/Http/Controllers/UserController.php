<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DataTables;
use App\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        if (request()->ajax() || 1==2) 
        {
            $users = User::query();
            return DataTables()
            ::of($users)
            ->addColumn('action',
                function ($users) {
                    $html ='<a href="' . route('users.edit', ['id'=>$users->id]) . '" class="btn btn-primary btn-rounded waves-effect waves-light"> <i class="glyphicon glyphicon-edit"></i> edit </a>';
                    $html .='<a href="' . route('users.destroy', ['id'=>$users->id]) . '" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="return confirm("Confirm delete?")"> <i class="fa fa-trash"></i> delete  </a>';
                    return $html;
                }
            )
            ->toJson();
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->get_all_role_names();
        return view('user.create',compact('roles'));
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
        $user = new User;
        if(!is_null($request->name))
        $user->name = $request->name;

        if(!is_null($request->image))
        $user->image = $request->image;

        if(!is_null($request->email))
        $user->email = $request->email;

        if(!is_null($request->password))
        $user->password = Hash::make($request->password);

        if(!is_null($request->name))
        $user->mobile = $request->mobile;

        if(!is_null($request->name))
        $user->address = $request->address;

        if(!is_null($request->name))
        $user->type = $request->type;
        $user->save();

        $user->syncRoles($request->roles);

        return view('user.index')->with('flash_message', 'no added!');
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
        $user = User::findOrFail($id);

        return view('user.show', compact('user'));
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
        $user = User::findOrFail($id);
        $oldRoles = $user->getRoleNames();
        $roles = $this->get_all_role_names();
        //dd($roles);
        return view('user.edit', compact('user','roles','oldRoles'));
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
        $user = User::findOrFail($id);
        if(!is_null($request->name))
        $user->name = $request->name;

        if(!is_null($request->image))
        $user->image = $request->image;

        if(!is_null($request->email))
        $user->email = $request->email;

        if(!is_null($request->password))
        $user->password = Hash::make($request->password);

        if(!is_null($request->name))
        $user->mobile = $request->mobile;

        if(!is_null($request->name))
        $user->address = $request->address;

        if(!is_null($request->name))
        $user->type = $request->type;
        $user->save();

        if(!is_null($request->name))
        $user->syncRoles($request->roles);
        //dd($request->roles);

        return view('user.index')->with('flash_message', 'no updated!');
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
        User::destroy($id);

        return view('user.index')->with('flash_message', 'no deleted!');
    }

    public function get_all_role_names(){
        $roles = Role::get()->pluck('name','name');
        //$roles = Role::get()->pluck('name')->toArray();
        return $roles;
    }

}
