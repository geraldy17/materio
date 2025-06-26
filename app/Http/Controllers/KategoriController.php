<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;

class KategoriController extends Controller
{
  public function index()
  {
    $kategori = Kategori::paginate(10);
    return view('kategori.index', compact('kategori'));
  }
  public function store(Request $request)
  {
    $kategori = Kategori::create([
      'nama_kategori' => $request->nama_kategori,
    ]);
    return redirect()->route('kategori.index');
  }
   public function update($id, Request $request)
  {
    $kategori = Kategori::findOrFail($id);
    $kategori->nama_kategori = $request->input('nama_kategori');
    $kategori->save();

    return redirect()->route('kategori.index');
  }

  public function destroy($id)
  {
    $kategori = Kategori::findOrFail($id);
    $kategori->delete();
    return redirect()->route('kategori.index');
  }
}
