<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function GetUsers()
  {
    $users = User::paginate(10);
    return view('admin.users')->with('users', $users);
  }

  public function logout()
  {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/admin');
  }

  public function  create()
  {
    return view('admin.users_add');
  }

  public function  Store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'login' => 'required|max:255',
      'password' => 'required',
      'categories' => 'required',

    ]);



    $user = new User();
    $user->name = Input::get('name');
    $user->email = Input::get('login');
    $user->password = bcrypt(Input::get('password'));
    $user->status = Input::get('categories');

    $user->save();

    return redirect('/admin/users');
  }

  public function Show(Request $request)
  {
    $user = User::where('id', '=', Input::get('id'))->first();
    return view('admin.users_edit')->with('user', $user);
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'password' => 'required',
      'confirm_password' => 'required',
      'categories' => 'required',
      'id' => 'required',

    ]);

    $user = User::find(Input::get('id'));
    if (Input::get('password') == Input::get('confirm_password')) {
      $user->name = Input::get('name');
      $user->status = Input::get('categories');
      $user->password = bcrypt(Input::get('confirm_password'));
      $user->update();

      return redirect('/admin/users/');
    }
  }

  public function  destroy(Request $request, $id)
  {
    $user = User::find(Input::get('id'));
    $user->delete();

    return redirect('/admin/users/');
  }

  public function Profile()
  {
    $user = Auth::user();
    return view('admin.profile')->with('user', $user);
  }
  public function profile_update(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'old_password' => 'required|max:255',
      'new_password' => 'required',
      'confirm_password' => 'required',

    ]);

    $user = Auth::user();

    //dd(Input::all());

    if (Hash::check(Input::get('old_password'), $user->password)) {
      if (Input::get('new_password') == Input::get('confirm_password')) {
        $user->name = Input::get('name');
        $user->password = Hash::make(Input::get('confirm_password'));
        $user->update();
        return redirect('/admin/users/profile/');
      }
    }
  }
}
