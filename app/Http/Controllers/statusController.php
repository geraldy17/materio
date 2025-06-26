<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Menu_Agenda;
use Illuminate\Http\Request;

class StatusController extends Controller
{
  public function index()
  {
    $status = Status::all();
    $menu_agenda = Menu_Agenda::all();
    return view('status/index', compact('status', 'menu_agenda'));
  }
  public function store(Request $request)
  {
    $cekAgendaID = Status::where('menu_agenda_id', $request->agenda_id)->first();

    // Cek apakah user_id sudah ada
    if ($cekAgendaID) {
      Status::where('menu_agenda_id', $request->agenda_id)->update([
        'status' => $request->status,
        'keterangan' => $request->keterangan,
      ]);
    } else {
      Status::create([
        'menu_agenda_id' => $request->agenda_id,
        'status' => $request->status,
        'keterangan' => $request->keterangan,
      ]);
    }
    return redirect()->route('status.index');

    // dd($request);
  }

  public function update(Request $request)
  {
    $status = Status::findOrFail($request->agenda_id);
    $status->menu_agenda_id = $request->input('menu_agenda_id');
    $status->status = $request->input('status');
    $status->keterangan = $request->input('keterangan');
    $status->save();

    return redirect()->route('status.index');
    // dd($request);
  }

  public function destroy($id)
  {
    $status = Status::findOrFail($id);
    $status->delete();
    return redirect()->route('status.index');
  }
}
