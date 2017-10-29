<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateFact;
use Illuminate\Support\Facades\Auth;
use App\Fact;
use App\FactTag;
use App\Page;
use App\Role;
use App\Tag;
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
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }

    public function create()
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage Facts")->setAction("create");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();

        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }

    public function save(CreateFact $request)
    {
        if (session()->has('fact_image_temp')) {
            $request['fact_image'] = session()->get('fact_image_temp');
            // session()->forget('fact_image_temp');
            session()->put('fact_image_temp', null);
        }
        if(Auth::user()->role_id > 1) {
            $request['is_approved'] = isset($request->is_approved) ? 1 : 0;
        }
        $request['tags'] = json_encode($request['tags']);

        $obj = new Fact($request->all());
        $obj->created_by = Auth::user()->id;
        DB::statement("ALTER TABLE `facts` AUTO_INCREMENT = 1");

        // dd($obj);
        $obj->save();

        $request['tags'] = json_decode($request['tags']);
        if ( $request['tags'] != null ) {
            foreach ($request['tags'] as $key => $value) {
                if (Tag::where('tag', $value)->count() == 0) {
                    $t = new Tag();
                    $t->tag = $value;
                    $t->save();
                } else {
                    $t = Tag::where('tag', $value)->first();
                }
                // if (FactTag::where([['fact_id', '=', $obj->id], ['tag_id', '=', $t->id]])->count() == 0) {
                //     $ft = new FactTag();
                //     $ft->fact_id = $obj->id;
                //     $ft->tag_id = $t->id;
                //     $ft->save();
                // } else {
                    
                // }
            }
        }

        session()->flash('success', 'Fact is SUCCESSFULLY created!');
        return redirect()->route('create_fact');
    }

    public function edit($id)
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage Facts")->setAction("update");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        $active_object = Fact::where('id', $id)->first();
        return view('fact')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users)
            ->with('active_object', $active_object);
    }

    public function update(CreateFact $request, $id)
    {
        if (session()->has('fact_image_temp')) {
            $request['fact_image'] = session()->get('fact_image_temp');
            // session()->forget('fact_image_temp');
            session()->put('fact_image_temp', null);
        }
        if(Auth::user()->role_id > 1) {
            $request['is_approved'] = isset($request->is_approved) ? 1 : 0;
        }
        $request['tags'] = json_encode($request['tags']);

        $obj = Fact::where('id', $id)->get()->first();

        // dd($obj);
        $obj->update($request->all());

        $request['tags'] = json_decode($request['tags']);
        if ( $request['tags'] != null ) {
            foreach ($request['tags'] as $key => $value) {
                if (Tag::where('tag', $value)->count() == 0) {
                    $t = new Tag();
                    $t->tag = $value;
                    $t->save();
                } else {
                    $t = Tag::where('tag', $value)->first();
                }
                // if (FactTag::where([['fact_id', '=', $obj->id], ['tag_id', '=', $t->id]])->count() == 0) {
                //     $ft = new FactTag();
                //     $ft->fact_id = $obj->id;
                //     $ft->tag_id = $t->id;
                //     $ft->save();
                // } else {
                    
                // }
            }
        }

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
