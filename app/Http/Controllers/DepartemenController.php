<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\User;

class DepartemenController extends Controller
{
  public function index()
  {
    $departemen = Departemen::paginate(10);
    $users = User::all();
    return view('Departemen', compact('departemen', 'users'));
  }


  public function store(Request $request)
  {
    $departemen = Departemen::create([
      'nama_departemen' => $request->nama_departemen,
      'kepala_departemen' => $request->kepala_departemen,
      'status' => $request->department_status,
    ]);
    return redirect()->route('departemen.index');

  }
   public function update($id, Request $request)
  {
    $departemen = Departemen::findOrFail($id);
    $departemen->nama_departemen = $request->input('nama_departemen');
    $departemen->kepala_departemen = $request->input('kepala_departemen');
    $departemen->status = $request->input('department_status');
    $departemen->save();

    return redirect()->route('departemen.index');
  }

  public function destroy($id)
  {
    $departemen = Departemen::findOrFail($id);
    $departemen->delete();
    return redirect()->route('departemen.index');
  } 
}
