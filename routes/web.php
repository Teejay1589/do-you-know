<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'PublicController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'AuthController@profile')->name('profile');
Route::post('/profile', 'AuthController@update')->name('update_profile');
Route::post('/profile/change_password', 'AuthController@change_password')->name('change_password');
// AJAX
Route::post('/upload-avatar', function(Request $request) {
    $avatar_temp = '';
    if ($request->hasFile('avatar_temp')) {
        if ($request->file('avatar_temp')->isValid()) {
            $new_filename = Auth::user()->username."-".rand(1000000,9999999).".".$request->avatar_temp->extension();

            // Move Uploaded File
            $destinationPath = 'uploads/avatar/';
            if ($request->avatar_temp->move($destinationPath, $new_filename) ) {
                $avatar_temp = $destinationPath.$new_filename;
				session()->put('avatar_temp', $avatar_temp);
            }
        }
    }
    return Response::json(asset($avatar_temp));
});

// Manage Facts
Route::get('/fact', 'FactController@index')->name('fact');
Route::get('/fact/create', 'FactController@create')->name('create_fact');
Route::post('/fact/create', 'FactController@save')->name('save_fact');
Route::get('/fact/update/{id}', 'FactController@edit')->name('edit_fact');
Route::post('/fact/update/{id}', 'FactController@update')->name('update_fact');
Route::get('/fact/delete/{id}', 'FactController@delete')->name('delete_fact');
// AJAX
Route::post('/upload-fact_image', function(Request $request) {
    $fact_image_temp = '';
    if ($request->hasFile('fact_image_temp')) {
        if ($request->file('fact_image_temp')->isValid()) {
            $new_filename = Auth::user()->username."-".rand(1000000,9999999).".".$request->fact_image_temp->extension();

            // Move Uploaded File
            $destinationPath = 'uploads/fact-image/';
            if ($request->fact_image_temp->move($destinationPath, $new_filename) ) {
                $fact_image_temp = $destinationPath.$new_filename;
                session()->put('fact_image_temp', $fact_image_temp);
            }
        }
    }
    return Response::json(asset($fact_image_temp));
});

// Manage System
// Users
Route::get('/users', 'ManageController@users')->name('manage.users');
// Facts
Route::get('/facts', 'ManageController@facts')->name('manage.facts');
// Tags
Route::get('/tags', 'ManageController@tags')->name('manage.tags');