<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();

            // Check if the file extension is jpeg, png, jpg, or gif
            if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
                $path = $file->store('profile_pics', 'public');

                $request->session()->put('imagePath', $path);
            }
        }

        $validators = [
            'profile' => 'file|mimes:jpeg,png,jpg,gif|max:5000',
            'name' => 'required|max:100|regex:/^[A-Za-z\'\s]+$/',
            'id' => 'required|max:15|regex:/^\d{2}[A-Z]{3}\d{5}$/|unique:students,stud_id',
            'email' => 'required|max:50|regex:/^[A-Za-z0-9._%+-]+@student\.tarc\.edu\.my$/|unique:students,email',
            'address' => 'required|max:256',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            're_pass' => 'required|same:pass'
        ];

        $errMsgs = [
            'profile.file' => 'Please upload image file.',
            'profile.mimes' => 'Supported image file (jpeg, png, jpg, gif).',
            'profile.max' => 'Please upload image file not larger than 5MB.',
            'name.required' => 'Name should not be empty.',
            'name.max' => 'Name should only be 100 characters long.',
            'name.regex' => 'Name should contains alphabets, hyphens, apostrophes and spaces only.',
            'id.required' => 'ID should not be empty.',
            'id.max' => 'ID should only be 15 characters long.',
            'id.regex' => 'ID should follow the pattern : [12ABC12345].',
            'id.unique' => 'ID is already registered.',
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern : [...@student.tarc.edu.my].',
            'email.unique' => 'Email is already registered.',
            'address.required' => 'Address should not be empty.',
            'address.max' => 'Address should only be 256 characters long.',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.',
            're_pass.required' => 'Re-enter password should not be empty.',
            're_pass.same' => 'Re-enter password should be same with Password.',
        ];

        $validated = $request->validate($validators, $errMsgs);

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();

            // Check if the file extension is jpeg, png, jpg, or gif
            if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
                $fileName = bin2hex(random_bytes(5)) . '.' . $extension;
                $filePath = public_path('img/profile_pic/');

                // Move the uploaded file to the specified directory
                $file->move($filePath, $fileName);
            }
        } else if ($request->session()->has('imagePath')) {
            $oldPath = storage_path('app/public/' . $request->session()->get('imagePath'));
            $fileName = basename($oldPath);
            $newPath = public_path('img/profile_pic/' . $fileName);

            if (File::exists($oldPath)) {
                if (File::move($oldPath, $newPath)) {
                    // dd("Success");
                } else {
                    // dd("Failed to move the file");
                }
            } else {
                // dd("Failed to find the file");
            }

        } else {
            $defaultProfilePath = public_path('img/default_profile.png');
            $fileName = bin2hex(random_bytes(5)) . '.png';
            $filePath = public_path('img/profile_pic/');

            // Copy default file to the specified directory
            copy($defaultProfilePath, $filePath . $fileName);
        }

        // Clear student selected profile image session
        $request->session()->forget('profile_image');
        $request->session()->forget('imagePath');

        $newStud = new Student();
        $newStud->stud_id = $request->id;
        $newStud->email = $request->email;
        $newStud->password = Hash::make($request->pass);
        $newStud->name = $request->name;
        $newStud->address = $request->address;
        $newStud->profile_pic = $fileName;
        $newStud->is_email_verified = 0;
        $newStud->save();

        // Send email verification
        MailController::verifyEmail($newStud->email, $request->id);

        return view('students.pendingEmailVerify')->with([
            'email' => $newStud->email,
            'studID' => $request->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

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
        $student = Student::find($request->session()->get('studID'));
        if ($request->actionTaken == "changeProfile") {

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();

                // Check if the file extension is jpeg, png, jpg, or gif
                if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
                    $path = $file->store('profile_pics', 'public');

                    $request->session()->put('imagePath', $path);
                }
            }

            $validators = [
                'profile' => 'file|mimes:jpeg,png,jpg,gif|max:5000',
                'name' => 'required|max:100|regex:/^[A-Za-z\'\s]+$/',
                'address' => 'required|max:256'
            ];

            $errMsgs = [
                'profile.file' => 'Please upload image file.',
                'profile.mimes' => 'Supported image file (jpeg, png, jpg, gif).',
                'profile.max' => 'Please upload image file not larger than 5MB.',
                'name.required' => 'Name should not be empty.',
                'name.max' => 'Name should only be 100 characters long.',
                'name.regex' => 'Name should contains alphabets, hyphens, apostrophes and spaces only.',
                'id.required' => 'ID should not be empty.',
                'address.required' => 'Address should not be empty.',
                'address.max' => 'Address should only be 256 characters long.'
            ];

            $validated = $request->validate($validators, $errMsgs);

            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();

                // Check if the file extension is jpeg, png, jpg, or gif
                if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
                    $fileName = bin2hex(random_bytes(5)) . '.' . $extension;
                    $filePath = public_path('img/profile_pic/');

                    // Move the uploaded file to the specified directory
                    $file->move($filePath, $fileName);
                }
            } else if ($request->session()->has('imagePath')) {
                $oldPath = storage_path('app/public/' . $request->session()->get('imagePath'));
                $fileName = basename($oldPath);
                $newPath = public_path('img/profile_pic/' . $fileName);

                if (File::exists($oldPath)) {
                    if (File::move($oldPath, $newPath)) {
                        // dd("Success");
                    } else {
                        // dd("Failed to move the file");
                    }
                } else {
                    // dd("Failed to find the file");
                }

            } else {
                $fileName = $student->profile_pic;
            }

            // Clear student selected profile image session
            $request->session()->forget('profile_image');
            $request->session()->forget('imagePath');


            $student->name = $request->input('name');
            $student->address = $request->input('address');
            $student->profile_pic = $fileName;
            $student->save();

        } else if ($request->actionTaken == "changePassword") {
            if (Hash::check($request->old_pass, $student->password)) {
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
                $student->password = Hash::make($request->pass);
                $student->save();

            } else {
                return redirect()->back()->withErrors(['old_pass' => 'Incorrect password.'])->withInput();
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function pendingVerify()
    {
        return view('students.pendingEmailVerify');
    }

    public function successVerify()
    {
        return view('students.successEmailVerify');
    }

    public function loginPage()
    {
        return view('students.login');
    }

    public function login(Request $request)
    {
        $validators = [
            'id' => 'required|max:15|regex:/^\d{2}[A-Z]{3}\d{5}$/',
            'pass' => 'required|max:100|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ];

        $errMsgs = [
            'id.required' => 'ID should not be empty.',
            'id.max' => 'ID should only be 15 characters long.',
            'id.regex' => 'ID should follow the pattern : [12ABC12345].',
            'pass.required' => 'Password should not be empty.',
            'pass.max' => 'Password should only be 100 characters long.',
            'pass.min' => 'Password should be at least 8 characters long.',
            'pass.regex' => 'Password should contains at least 1 uppercase, 1 lowercase, 1 digit and 1 special character.'
        ];

        $validated = $request->validate($validators, $errMsgs);
        $student = Student::where('stud_id', $request->id)->first();

        // Check if ID exist in system
        if ($student) {
            // Check if password correct
            if (Hash::check($request->pass, $student->password)) {

                // regenerate session id & remove all session data
                $request->session()->invalidate();

                // set session
                $request->session()->put('role', 'student');
                $request->session()->put('studID', $request->id);

                // back to home
                return redirect('/');

            } else {
                return redirect()->back()->withErrors(['pass' => 'Incorrect password.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['id' => 'Student ID does not exist in the system.'])->withInput();
        }
    }

    public function resetPasswordEmail()
    {
        return view('students.resetPasswordEmail');
    }

    public function getCode(Request $request)
    {
        $validators = [
            'email' => 'required|max:50|regex:/^[A-Za-z0-9._%+-]+@student\.tarc\.edu\.my$/'
        ];

        $errMsgs = [
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern: [...@student.tarc.edu.my].',
        ];

        $request->validate($validators, $errMsgs);

        $student = Student::where('email', $request->email)->first();

        if ($student) {
            // Safe email that required password change
            $request->session()->put('resetEmail', $request->email);

            // Generate and set code
            $randomCode = Str::random(8);
            $request->session()->put('resetCode', $randomCode);

            // send email
            MailController::resetPassword($request->email, $randomCode);

            return redirect('/students/resetPasswordPage');
        } else {
            return redirect()->back()->withErrors(['email' => 'Email does not exist in the system.'])->withInput();
        }
    }

    public function resetPasswordPage()
    {
        return view('students.resetPassword');
    }

    public function resetPassword(Request $request)
    {
        // Retrieve the session value
        $sessionCode = $request->session()->get('resetCode');
        $email = $request->session()->get('resetEmail');

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

            // Find the student with the matching email
            $stud = Student::where('email', $email)->first();

            if ($stud) {
                // Update the password
                $stud->password = Hash::make($request->pass);
                $stud->save();

                // Clear the session data
                $request->session()->forget('resetEmail');
                $request->session()->forget('resetCode');

                return view('students.successPasswordReset');
            } else {
                return redirect()->back()->withErrors(['re_pass' => 'Something went wrong. Please try again later.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['code' => 'Wrong verification code entered.'])->withInput();
        }


    }

    public function profile(Request $request)
    {
        $stud = Student::where('stud_id', $request->session()->get('studID'))->first();

        return view('students.profile')->with('stud', $stud);
    }
}
