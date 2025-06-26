<?php

namespace App\Http\Controllers;

use App\Models\Menu_agenda;
use Illuminate\Http\Request;
use App\Models\schedule;
use App\Models\kategori;

class Menu_agendaController extends Controller
{
  public function index()
  {
    if (auth()->user()->id == 1) {
      $menu_agenda = Menu_agenda::paginate(10);
    } else {
      $menu_agenda = Menu_agenda::where('user_id', auth()->user()->id)->paginate(10);
    }

    $schedule = Schedule::all();
    $kategori = Kategori::all();
    return view('MenuAgenda', compact('menu_agenda', 'schedule', 'kategori'));
  }

  public function store(Request $request)
  {
    $menu_agenda = Menu_agenda::create([
      'schedule_id' => $request->schedule_id,
      'kategori_id' => $request->kategori_id,
      'user_id' => auth()->user()->id,
      'judul' => $request->judul,
      'latar_belakang_keputusan' => $request->latar_belakang_keputusan,
      'keputusan_komite' => $request->keputusan_komite,
      'tempat' => $request->tempat,
      'biaya' => $request->biaya,
      'rincian_biaya' => $request->rincian_biaya,
      'panitia' => $request->panitia,
      'peserta' => $request->peserta,
    ]);
    // dd(auth()->user()->id);
    return redirect()->route('menuagenda.index');
  }
  public function update($id, Request $request)
  {
    $menu_agenda = Menu_agenda::findOrFail($id);
    $menu_agenda->schedule_id = $request->input('schedule_id');
    $menu_agenda->kategori_id = $request->input('kategori_id');
    $menu_agenda->judul = $request->input('judul');
    $menu_agenda->latar_belakang_keputusan = $request->input('latar_belakang_keputusan');
    $menu_agenda->keputusan_komite = $request->input('keputusan_komite');
    $menu_agenda->tempat = $request->input('tempat');
    $menu_agenda->biaya = $request->input('biaya');
    $menu_agenda->rincian_biaya = $request->input('rincian_biaya');
    $menu_agenda->panitia = $request->input('panitia');
    $menu_agenda->peserta = $request->input('peserta');
    $menu_agenda->save();

    return redirect()->route('menu_agenda.index');
  }

  public function destroy($id)
  {
    $menu_agenda = Menu_agenda::findOrFail($id);
    $menu_agenda->delete();
    return redirect()->route('menu_agenda.index');
  }
}
