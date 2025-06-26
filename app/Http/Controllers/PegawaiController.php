<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Departemen;

class PegawaiController extends Controller
{
  public function index()
  {
    $pegawai = Pegawai::paginate(10);
    $users = User::all();
    $departemen = Departemen::all();
    // dd($departemen);
    return view('pegawai.index', compact('pegawai', 'users', 'departemen'));
  }

  public function store(Request $request)
  {
    // Cek apakah user_id sudah ada
    $existingPegawai = Pegawai::where('user_id', $request->user_id)->first();
    if ($existingPegawai) {
      // Set pesan error ke session
      return redirect()
        ->back()
        ->with('error', 'User ID ini telah digunakan.');
    } else {
      // Insert data baru jika user_id belum digunakan
      $pegawai = Pegawai::create([
        'nama_pegawai' => $request->nama_pegawai,
        'user_id' => $request->user_id,
        'departemen_id' => $request->departemen_id,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
      ]);
      // Redirect ke halaman index dengan pesan sukses
      return redirect()
        ->route('pegawai.index')
        ->with('success', 'Pegawai berhasil ditambahkan.');
    }
  }

  public function show(Pegawai $pegawai)
  {
    $pegawai->load(['user', 'departemen']);
    return view('pegawai.show', compact('pegawai'));
  }
  public function update($id, Request $request)
  {
    $pegawai = Pegawai::findOrFail($id);
    $pegawai->nama_pegawai = $request->input('nama_pegawai');
    $pegawai->user_id = $request->input('user_id');
    $pegawai->departemen_id = $request->input('departemen_id');
    $pegawai->tempat_lahir = $request->input('tempat_lahir');
    $pegawai->tanggal_lahir = $request->input('tanggal_lahir');
    $pegawai->jenis_kelamin = $request->input('jenis_kelamin');
    $pegawai->save();

    return redirect()->route('pegawai.index');
  }

  public function destroy($id)
  {
    $pegawai = Pegawai::findOrFail($id);
    $pegawai->delete();
    return redirect()->route('pegawai.index');
  }
}
