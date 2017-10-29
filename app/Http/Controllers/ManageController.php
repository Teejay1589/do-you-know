<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class ManageController extends Controller
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

    public function users()
    {
        if (Auth::user()->role_id < 3) {
            return redirect()->route('/')->withErrors('You are not permitted to view intended page!');
        }
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage System")->setAction("users");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        return view('manage')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }

    public function facts()
    {
        if (Auth::user()->role_id < 3) {
            return redirect()->route('/')->withErrors('You are not permitted to view intended page!');
        }
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage System")->setAction("facts");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        return view('manage')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }

    public function tags()
    {
        if (Auth::user()->role_id < 3) {
            return redirect()->route('/')->withErrors('You are not permitted to view intended page!');
        }
        $page = new Page();
        $page->setLayout("auth")->setTitle("Manage System")->setAction("tags");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        return view('manage')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }
}
