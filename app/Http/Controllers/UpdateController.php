<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update($id)
    {
        // Logic to update the database based on the $id
        Student::where('stud_id', $id)->update(['is_email_verified' => 1]);

        // Redirect to a thank you page or any other relevant page
        return redirect('/thank-you');
    }
}
