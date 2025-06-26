<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Menu_agenda;

class ScheduleController extends Controller
{
  public function index()
  {
    $schedule = Schedule::paginate(10);
    return view('schedule.index', compact('schedule'));
  }

  public function store()
  {
    $schedule = new Schedule();
    $schedule->name = request('name');
    $schedule->date = request('tanggal');
    $schedule->start_time = request('buka_agenda');
    $schedule->end_time = request('tutup_agenda');
    $schedule->save();
    return redirect('/schedule');
  }

  public function show($id)
  {
    $schedule = Schedule::find($id);
    return view('schedule.show', compact('schedule'));
  }

  public function list_agenda($id_schedule)
  {
    $agenda = Menu_agenda::where('schedule_id', $id_schedule)->get();
    return view('agenda.index', compact('agenda'));
  }
  public function update($id, Request $request)
  {
    $schedule = Schedule::findOrFail($id);
    $schedule->name = $request->input('name');
    $schedule->date = $request->input('tanggal');
    $schedule->start_time = $request->input('buka_agenda');
    $schedule->end_time = $request->input('tutup_agenda');
    $schedule->save();

    return redirect('/schedule');
  }

  public function destroy($id)
  {
    $schedule = Schedule::findOrFail($id);
    $schedule->delete();
    return redirect('/schedule');
  }
}
