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
    $user->name = $request->name;
    $user->email = $request->login;
    $user->password = bcrypt($request->password);
    $user->status = $request->categories;

    $user->save();

    return redirect('/admin/users');
  }

  public function Show(Request $request)
  {
    $user = User::where('id', '=', $request->id)->first();
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

    $user = User::find($request->id);
    if ($request->password == $request->confirm_password) {
      $user->name = $request->name;
      $user->status = $request->categories;
      $user->password = bcrypt($request->confirm_password);
      $user->update();

      return redirect('/admin/users/');
    }
  }

  public function  destroy(Request $request, $id)
  {
    $user = User::find($request->id);
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

    $user = auth()->user();
    $user = User::find($user->id);
    if (Hash::check($request->old_password, $user->password)) {
      if ($request->new_password == $request->confirm_password) {
        $user->name = $request->name;
        $user->password = Hash::make($request->confirm_password);
        $user->save();
        return redirect('/admin/users/profile/');
      }
    }
  }
}
