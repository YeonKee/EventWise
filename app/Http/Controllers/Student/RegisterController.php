<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    // ... Other methods and logic ...

    protected function create(array $data)
    {
        // return Student::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);
    }

    protected function registered($request, $student)
    {
        event(new Registered($student));

        $this->guard()->logout();

        return redirect(route('login'))
            ->withSuccess('Registration successful. Please check your email to verify your account.');
    }
}