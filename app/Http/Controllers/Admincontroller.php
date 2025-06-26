<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class Admincontroller extends Controller
{
  function index()
  {
    $schedule = Schedule::paginate(10);
    return view('content.dashboard.dashboards-analytics', compact('schedule'));
  }

  function pengguna()
  {
    $schedule = Schedule::paginate(10);
    return view('content.dashboard.dashboards-analytics', compact('schedule'));
  }

  function sekretaris()
  {
    $schedule = Schedule::paginate(10);
    return view('content.dashboard.dashboards-analytics', compact('schedule'));
  }
}
