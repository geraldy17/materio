<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, $role): Response
  {
    if (auth()->user()->role == $role) {
      return $next($request);
    }
    //  if ($request->user()->id !== $request->route('menu_agenda')->user_id) {
    //         return redirect('/home')->with('error', 'You do not have access to this agenda.');
    //     }
    return redirect('admin');
     return $next($request);
  }
}
