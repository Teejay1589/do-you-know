<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfile;
use App\Http\Requests\ChangeUserPassword;
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
use Illuminate\Hashing\BcryptHasher;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $page = new Page();
        $page->setLayout("auth")->setTitle("Update Profile")->setAction("");
        $facts = Fact::all();
        $fact_tags = FactTag::all();
        $roles = Role::all();
        $tags = Tag::all();
        $users = User::all();
        
        // Auth::user()->facts = Fact::where('created_by', Auth::user()->id)->get();
        Auth::user()->facts = Auth::user()->facts()->get();

        return view('profile')
            ->with('page', $page)
            ->with('facts', $facts)
            ->with('fact_tags', $fact_tags)
            ->with('roles', $roles)
            ->with('tags', $tags)
            ->with('users', $users);
    }

    public function update(UpdateUserProfile $request)
    {
        if (session()->has('avatar_temp')) {
            $request['avatar'] = session()->get('avatar_temp');
            session()->forget('avatar_temp');
        }
        if(Auth::user()->role_id == 3) {
            $request['role_id'] = $request->role;
        } else {
            $request['role_id'] = Auth::user()->role_id;
        }

        Auth::user()->update($request->all());

        session()->flash('success', 'Profile successfully updated!');
        return redirect()->route('profile');
    }

    public function change_password(ChangeUserPassword $request)
    {
        $user = User::where('id', Auth::user()->id)->get()->first();
        $bcrypt = new BcryptHasher;

        if( $bcrypt->check($request->current_password, $user->password) ) {
            $user->password = bcrypt($request->new_password);

            $user->save();

            // session()->flash('success', 'Password SUCCESSFULLY Changed, Please relogin to continue!');
            session()->flash('success', 'Password successfully Changed!');
            return redirect()->route('profile');
        } else {
            return redirect()->route('profile')->withErrors(array('current_password' => 'Current Password entered is incorrect, PASSWORD UNCHANGED!'))->withInput();
        }
    }

    public function update_user_settings(UpdateUserSettings $request)
    {
        if( UserSetting::where('user_id', Auth::user()->id)->count() == 0 ) {
            // $request['user_id'] = Auth::user()->id;
            $obj = new UserSetting();
            $obj->user_id = Auth::user()->id;
            $obj->color = $request->color;
            DB::statement("ALTER TABLE `user_settings` AUTO_INCREMENT = 1");

            $obj->save($request->all());
        } else {
            $obj = UserSetting::where('user_id', Auth::user()->id)->first();
            $obj->update($request->all());
        }

        session()->flash('success', 'User Settings successfully updated!');
        return redirect()->route('profile');
    }

    // protected function formatErrors(Validator $validator) {
    //     return $validator->errors()->all();
    // }
    
 //    public function logout()
	// {
	//     Auth::logout();

 //        session()->flash('success', 'You are now logged out!');
	//     return redirect()->route('welcome');
	// }
}
