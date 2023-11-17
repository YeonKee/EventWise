<?php

namespace App\Facades;

use App\Models\Student;
use App\Models\Staff;
use Session;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SessionManager
{
    protected $maxAttempts = 5;

    /*
    public function showLogin()
    {
        return view('students.login')->with('maxAttempts', $this->maxAttempts);
    }

    public function doLogin(Request $request)
    {
        $s = Student::where('stud_id', $request->id)->first();

        // customer found
        if ($s != null) {

            // correct password
            if (Hash::check($request->password, $s->password)) {

                // need reset password
                if (Cookie::get('try_password') >= 5) {
                    return redirect('/students/login');
                } else {
                    // regenerate session id & remove all session data
                    $request->session()->invalidate();

                    // set session
                    $request->session()->put('role', 'students');
                    $request->session()->put('stud_id', $s->cust_id);

                    // delete cookie
                    Cookie::forget('try_password');

                    // back to home
                    return redirect('/homepage');
                }
            } else {
                // incorrect password
                $tried = 0;

                if ($val = Cookie::get('try_password')) {
                    $tried = $val + 1;
                    Cookie::queue('try_password', $tried);
                } else {
                    Cookie::queue('try_password', 1);
                }

                // wrong password
                return redirect('/students/login?wrongPassword');
            }
        } else {
            // student not found
            Session::flash('noEmail', $request->email);
            return redirect('/students/login?accountNotExist');
        }
    }

    public function showLoginStaff()
    {
        return view('staffs.login');
    }

    public function doLoginStaff(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        $s = Staff::find($request->id);

        // staff found
        if ($s != null) {
            // correct password
            if (Hash::check($request->password, $s->password)) {
                // regenerate session id & remove all session data
                $request->session()->invalidate();

                // set session
                $request->session()->put('role', $s->account_type);
                $request->session()->put('user_id', $s->staff_id);

                // go to page
                if ($s->account_type == 'admin')
                    return redirect('/staffs');
                else
                    return redirect('/customers');

            } else {
                // incorrect password
                return redirect('/staffs/login?error=passError');
            }
        } else {
            return redirect('/staffs/login?error=noStaff');
        }
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('role')) {

            $role = $request->session()->get('role');
            $msg = '';

            // regenerate session id & remove all data
            $request->session()->invalidate();

            if ($role == 'customer') {
                $msg = "Thanks for visiting. Please come again.";
            } else {
                $msg = "Thanks for using BeeVU system. See you again.";
            }

            return view('logout', ['message' => $msg]);
        } else {
            return redirect('/homepage');
        }
    }
    */
}