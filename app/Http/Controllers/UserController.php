<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    $users = User::paginate(10);
    return view('user.index', compact('users'));
  }

  public function store()
  {
    $password = Hash::make('123456');
    $user = new User();
    $user->name = request('name');
    $user->email = request('email');
    $user->password = $password;
    $user->save();
    return redirect()->route('user.index');
  }
   public function update($id, Request $request)
  {
    $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    
    if ($request->filled('password')) {
      $user->password = Hash::make($request->input('password'));
    }
    
    $user->save();
    return redirect()->route('user.index');
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('user.index');
  }
}