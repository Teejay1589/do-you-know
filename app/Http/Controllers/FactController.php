<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFact;
use Illuminate\Support\Facades\Auth;
use App\Fact;
use App\Page;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Redirect;
use Carbon;

class FactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage Facts")->setAction("");
        $facts = Fact::all();
        $roles = Role::all();
        $users = User::all();

        Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();

        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('roles', $roles)
            ->with('users', $users);
    }

    public function create()
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage Facts")->setAction("create");
        $facts = Fact::all();
        $roles = Role::all();
        $users = User::all();

        Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();

        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('roles', $roles)
            ->with('users', $users);
    }

    public function save(CreateFact $request)
    {
	    	$request['is_approved'] = isset($request->is_approved) ? 1 : 0;
        $obj = new Fact($request->all());
        $obj->created_by = Auth::user()->id;
        DB::statement("ALTER TABLE `facts` AUTO_INCREMENT = 1");

        // dd($obj);
        $obj->save();

        session()->flash('success', 'Fact is SUCCESSFULLY created!');
        return redirect()->route('create_fact');
    }

    public function edit($id)
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage Facts")->setAction("update");
        $facts = Fact::all();
        $roles = Role::all();
        $users = User::all();

        Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();

        $active_object = Fact::where('id', $id)->first();
        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('roles', $roles)
            ->with('users', $users)
            ->with('active_object', $active_object);
    }

    public function update(CreateFact $request, $id)
    {
        $request['is_approved'] = isset($request->is_approved) ? 1 : 0;
        $obj = Fact::where('id', $id)->get()->first();

        // dd($obj);
        $obj->update($request->all());

        session()->flash('success', 'Fact SUCCESSFULLY updated!');
        return redirect()->route('fact');
    }

    public function delete($id)
    {
    		Fact::where('id', $id)->delete();

        session()->flash('success', 'Fact SUCCESSFULLY deleted!');
        return redirect()->route('fact');
    }
}
