<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::where('account_type', 2)->get();
        return view('staffs.staffs.index', compact('staffs'));
    }


    public function dashboard()
    {
        return view('staffs.dashboard');
    }

    public function profile()
    {
        return view('staffs.profile');
    }

    public function livechat()
    {
        return view('staffs.livechat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestStaff = Staff::latest()->first();
        $newID = $latestStaff->staff_id + 1;

        return view('staffs.staffs.create')->with('staffID', $newID);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = [
            'name' => 'required|max:100|regex:/^[A-Za-z\'\s]+$/',
            'email' => 'required|max:50|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:staffs,email',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            're_pass' => 'required|same:pass'
        ];

        $errMsgs = [
            'name.required' => 'Name should not be empty.',
            'name.max' => 'Name should only be 100 characters long.',
            'name.regex' => 'Name should contains alphabets, hyphens, apostrophes and spaces only.',
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should valid email pattern : [...@gmail.com, ...@yahoo.com etc].',
            'email.unique' => 'Email is already registered.',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
            're_pass.required' => 'Re-enter password should not be empty.',
            're_pass.same' => 'Re-enter password should be same with Password.',
        ];

        $validated = $request->validate($validators, $errMsgs);

        $newStaff = new Staff();
        $newStaff->email = $request->email;
        $newStaff->password = Hash::make($request->pass);
        $newStaff->name = $request->name;
        $newStaff->account_type = 2;
        $newStaff->save();

        Alert::html('Registered Successfully!', 'Staff <b>' . e($request->name) . ' (ID: ' . $request->id . '</b>) has been registered.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->back();
    }

    public function viewAllStud()
    {
        $students = Student::all();
        return view('staffs.students.viewAllStud', compact('students'));
    }

    public function viewStudDetail($id)
    {
        $student = Student::where('stud_id', $id)->first();
        return view('staffs.students.viewStudDetail')->with(['student' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteStud($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back();
    }
}
