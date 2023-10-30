<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $userRole = session()->get('role');

        if ($userRole !== "student" && $userRole !== "staff" && $userRole !== "admin") {
            return redirect('/unauthorizedAccess');
        } else {
            if ($userRole === $role || ($userRole === 'admin' && ($role === 'staff' || $role === 'admin'))) {
                return $next($request);
            } else {
                if ($role === 'student') {
                    return redirect('/students/loginPage');
                } elseif ($role === 'staff' || $role === 'admin') {
                    return redirect('/staffs/loginPage');
                } else {
                    return redirect('/unauthorizedAccess');
                }
            }
        }
    }
}
