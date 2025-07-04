<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
  function index()
  {
    return view('login');
  }
  function login(Request $request)
  {
    $request->validate(
      [
        'email' => 'required',
        'password' => 'required',
      ],
      [
        'email.required' => 'Email wajib diisi',
        'password.required' => 'Password wajib diisi',
      ]
    );

    $infologin = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    if (Auth::attempt($infologin)) {
      if (Auth::user()->role == 'pengguna') {
        return redirect('admin/pengguna');
      } elseif (Auth::user()->role == 'sekretaris') {
        return redirect('admin/sekretaris');
      }
    } else {
      return redirect('')
        ->withErrors('Username dan password yang dimasukkan tidak sesuai')
        ->withInput();
    }

    //return view('content.dashboard.dashboards-analytics');
  }

  function logout()
  {
    Auth::logout();
    return redirect('');
  }
}
