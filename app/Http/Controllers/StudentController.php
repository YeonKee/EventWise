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
        $validators = [
            'profile'   => 'file|mimes:jpeg,png,jpg,gif|max:5000',
            'name'      => 'required|max:100|regex:/^[A-Za-z\'\s]+$/',
            'id'        => 'required|max:15|regex:/^\d{2}[A-Z]{3}\d{5}$/|unique:students,stud_id',
            'email'     => 'required|max:50|regex:/^[A-Za-z0-9._%+-]+@student\.tarc\.edu\.my$/|unique:students,email',
            'address'   => 'required|max:256',
            'pass'      => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            're_pass'   => 'required|same:pass'
        ];

        $errMsgs = [
            'profile.file'      => 'Please upload image file.',
            'profile.mimes'     => 'Supported image file (jpeg, png, jpg, gif).',
            'profile.max'       => 'Please upload image file not larger than 5MB.',
            'name.required'     => 'Name should not be empty.',
            'name.max'          => 'Name should only be 100 characters long.',
            'name.regex'        => 'Name should contains alphabets, hyphens, apostrophes and spaces only.',
            'id.required'       => 'ID should not be empty.',
            'id.max'            => 'ID should only be 15 characters long.',
            'id.regex'          => 'ID should follow the pattern : [12ABC12345].',
            'id.unique'         => 'ID is already registered.',
            'email.required'    => 'Email should not be empty.',
            'email.max'         => 'Email should only be 50 characters long.',
            'email.regex'       => 'Email should follow the pattern : [...@student.tarc.edu.my].',
            'email.unique'      => 'Email is already registered.',
            'address.required'  => 'Address should not be empty.',
            'address.max'       => 'Address should only be 256 characters long.',
            'pass.required'     => 'Password should not be empty.',
            'pass.max'          => 'Password should only be 100 characters long.',
            'pass.min'          => 'Password should be at least 8 characters long.',
            'pass.regex'        => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
            're_pass.required'  => 'Re-enter password should not be empty.',
            're_pass.same'      => 'Re-enter password should be same with Password.',
        ];

        $validated = $request->validate($validators, $errMsgs);
        
        $newStud = new Student();
        $newStud->stud_id = $request->id;
        $newStud->email = $request->email;
        $newStud->password = Hash::make($request->password);
        $newStud->name = $request->name;
        $newStud->address = $request->address;
        $newStud->save();

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = $request->id . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('img/profile_pic/');

            // Move the uploaded file to the specified directory
            $file->move($filePath, $fileName);
            
        } else{
            $defaultProfilePath = public_path('img/default_profile.png');
            $fileName = $request->id . '.png';
            $filePath = public_path('img/profile_pic/');

            // Copy default file to the specified directory
            copy($defaultProfilePath, $filePath . $fileName);
        }

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
