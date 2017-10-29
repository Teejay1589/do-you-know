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

class PublicController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = new Page();
        $page->setLayout("front")->setTitle("Home")->setAction("");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();

        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();

        return view('welcome')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }
}
