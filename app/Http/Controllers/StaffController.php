<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::where('account_type', 2)->paginate(9);
        $staffsCount = $staffs->total();
        return view('staffs.staffs.index', compact('staffs', 'staffsCount'));
    }

    public function searchStaff(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $staffs = Staff::where('account_type', 2)
                ->where(function ($q) use ($query) {
                    $q->where('staff_id', 'like', '%' . $query . '%')
                        ->orWhere('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('created_at', 'like', '%' . $query . '%');
                })
                ->paginate(9);
        } else {
            $staffs = Staff::where('account_type', 2)->paginate(9);
        }

        $staffsCount = $staffs->total();
        return view('staffs.staffs.index', compact('staffs', 'staffsCount'));
    }

    public function dashboard()
    {
        $totalStudents = Student::count();

        return view('staffs.dashboard')->with('totalStudents', $totalStudents);
    }

    public function profile(Request $request)
    {
        $staff = Staff::where('staff_id', $request->session()->get('staffID'))->first();

        return view('staffs.profile')->with('staff', $staff);
        ;
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
        $staff = Staff::find($request->session()->get('staffID'));
        if ($request->actionTaken == "changeProfile") {

            $validators = [
                'name' => 'required|max:100|regex:/^[A-Za-z\'\s]+$/'
            ];

            $errMsgs = [
                'name.max' => 'Name should only be 100 characters long.',
                'name.regex' => 'Name should contains alphabets, hyphens, apostrophes and spaces only.'
            ];

            $validated = $request->validate($validators, $errMsgs);

            $staff->name = $request->input('name');
            $staff->save();

            Alert::success('Updated Successfully!', 'Your profile information has been updated.');
            $request->session()->put('staffName', $staff->name);

            return redirect()->back();

        } else if ($request->actionTaken == "changePassword") {
            if (Hash::check($request->old_pass, $staff->password)) {
                $validators = [
                    'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                    're_pass' => 'required|same:pass'
                ];

                $errMsgs = [
                    'pass.required' => 'Password should not be empty.',
                    'pass.max' => 'Password should only be 100 characters long.',
                    'pass.min' => 'Password should be at least 8 characters long.',
                    'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
                    're_pass.required' => 'Re-enter password should not be empty.',
                    're_pass.same' => 'Re-enter password should be same with Password.',
                ];

                $validated = $request->validate($validators, $errMsgs);

                // Update the password
                $staff->password = Hash::make($request->pass);
                $staff->save();

                Alert::success('Updated Successfully!', 'Your password has been updated.');

                return redirect()->back();

            } else {
                return redirect()->back()->withErrors(['old_pass' => 'Incorrect password.'])->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->back()->with('query', '');
    }

    public function loginPage()
    {
        return view('staffs.login');
    }

    public function login(Request $request)
    {
        $validators = [
            'id' => 'required|max:15',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ];

        $errMsgs = [
            'id.required' => 'ID should not be empty.',
            'id.regex' => 'ID should follow the pattern : [12ABC12345].',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.'
        ];

        $validated = $request->validate($validators, $errMsgs);
        $staff = Staff::where('staff_id', $request->id)->first();

        // Check if ID exist in system
        if ($staff) {
            // Check if password correct
            if (Hash::check($request->pass, $staff->password)) {

                // regenerate session id & remove all session data
                $request->session()->invalidate();

                // set session
                if ($staff->account_type == 1) {
                    $request->session()->put('role', 'admin');
                } else if ($staff->account_type == 2) {
                    $request->session()->put('role', 'staff');
                }

                $request->session()->put('staffID', $request->id);
                $request->session()->put('staffName', $staff->name);

                // back to home
                return redirect('/');

            } else {
                return redirect()->back()->withErrors(['pass' => 'Incorrect password.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['id' => 'Staff ID does not exist in the system.'])->withInput();
        }
    }

    public function resetPasswordEmail()
    {
        return view('staffs.resetPasswordEmail');
    }

    public function getCode(Request $request)
    {
        $validators = [
            'email' => 'required|max:50|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        ];

        $errMsgs = [
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern: [...@student.tarc.edu.my].',
        ];

        $request->validate($validators, $errMsgs);

        $staff = Staff::where('email', $request->email)->first();

        if ($staff) {
            // Safe email that required password change
            $request->session()->put('resetEmailStaff', $request->email);

            // Generate and set code
            $randomCode = Str::random(8);
            $request->session()->put('resetCodeStaff', $randomCode);

            // send email
            MailController::resetPassword($request->email, $randomCode);

            return redirect('/staffs/resetPasswordPage');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email does not exist in the system.'])->withInput();
        }
    }

    public function resetPasswordPage()
    {
        return view('staffs.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        // Retrieve the session value
        $sessionCode = $request->session()->get('resetCodeStaff');
        $email = $request->session()->get('resetEmailStaff');

        // Compare the session value with the form data named 'code'
        if ($sessionCode == $request->code) {
            $validators = [
                'code' => 'required',
                'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                're_pass' => 'required|same:pass'
            ];

            $errMsgs = [
                'code.required' => 'Verification code should not be empty.',
                'pass.required' => 'Password should not be empty.',
                'pass.max' => 'Password should only be 100 characters long.',
                'pass.min' => 'Password should be at least 8 characters long.',
                'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
                're_pass.required' => 'Re-enter password should not be empty.',
                're_pass.same' => 'Re-enter password should be same with Password.',
            ];

            $validated = $request->validate($validators, $errMsgs);

            // Find the staff with the matching email
            $staff = Staff::where('email', $email)->first();

            if ($staff) {
                // Update the password
                $staff->password = Hash::make($request->pass);
                $staff->save();

                // Clear the session data
                $request->session()->forget('resetEmailStaff');
                $request->session()->forget('resetCodeStaff');

                return view('staffs.successPasswordReset');
            } else {
                return redirect()->back()->withErrors(['re_pass' => 'Something went wrong. Please try again later.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['code' => 'Wrong verification code entered.'])->withInput();
        }
    }


    public function viewAllStud()
    {
        $students = Student::paginate(9);
        $studentsCount = $students->total();
        return view('staffs.students.viewAllStud', compact('students', 'studentsCount'));
    }

    public function searchStudent(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $students = Student::where(function ($q) use ($query) {
                $q->where('stud_id', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $students = Student::paginate(9);
        }

        $studentsCount = $students->total();
        return view('staffs.students.viewAllStud', compact('students', 'studentsCount'));
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

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        // back to home
        return redirect('/');
    }
}
