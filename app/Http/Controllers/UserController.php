<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validation and updating logic for the user
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // Logic for deleting the user
    }
}
