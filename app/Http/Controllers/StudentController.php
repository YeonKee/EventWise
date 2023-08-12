<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staffs.students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'id'      => 'required',
            'email'   => 'required',
            'address' => 'required',
            'pass'    => 'required',
            're_pass' => 'required'
        ]);
        
        $newStud = new Student();
        $newStud->stud_id = $request->id;
        $newStud->email = $request->email;
        $newStud->password = Hash::make($request->password);
        $newStud->name = $request->name;
        $newStud->address = $request->address;
        $newStud->save();

        // if ($request->hasFile('profile')) {
        //     $this->saveProfile($request->profile, $newStud->cust_id);
        // }

        // return view('staffs.students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
