<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatRatingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TextGeneratorController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/

// Testing
Route::get('/chatTesting', function () {
    return view('chatTesting');
});

// Route to homepage
Route::get('/', function () {
    return view('homepage');
});

// Unauthorized Access
Route::get('/unauthorizedAccess', function () {
    return view('error.unauthorizedAccess');
});

// Page Not Found
Route::fallback(function () {
    return view('error.404');
});

// Student Register
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students/register', [StudentController::class, 'store']);
Route::get('/students/pendingEmailVerify', [StudentController::class, 'pendingVerify']);
Route::get('/students/successEmailVerify', [StudentController::class, 'successVerify']);

// Student Email Verification
Route::get('/updateDatabaseEmailVerification/{studID}', [UpdateController::class, 'updateEmailVerification'])->name('update.database.verifyEmail');
Route::get('/verifyEmail/{email}/{studID}', [MailController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/resentVerifyEmail/{email}/{studID}', [MailController::class, 'resentVerifyEmail'])->name('resentVerifyEmail');

// Student Login
Route::get('/students/loginPage', [StudentController::class, 'loginPage']);
Route::post('/students/login', [StudentController::class, 'login']);

// Student Forget Password
Route::get('/students/resetPasswordEmail', [StudentController::class, 'resetPasswordEmail']);
Route::post('/students/getCode', [StudentController::class, 'getCode']);
Route::get('/students/resetPasswordPage', [StudentController::class, 'resetPasswordPage']);
Route::post('/students/resetPassword', [StudentController::class, 'resetPassword']);
Route::get('/students/successPasswordReset', [StudentController::class, 'successReset']);

// Staff Login
Route::get('/staffs/loginPage', [StaffController::class, 'loginPage']);
Route::post('/staffs/login', [StaffController::class, 'login']);

// Staff Forget Password
Route::get('/staffs/resetPasswordEmail', [StaffController::class, 'resetPasswordEmail']);
Route::post('/staffs/getCode', [StaffController::class, 'getCode']);
Route::get('/staffs/resetPasswordPage', [StaffController::class, 'resetPasswordPage']);
Route::post('/staffs/resetPassword', [StaffController::class, 'resetPassword']);
Route::get('/staffs/successPasswordReset', [StaffController::class, 'successReset']);

// LiveChat
Route::get('/chat', [PusherController::class, 'index']);
Route::post('/broadcast', [PusherController::class, 'broadcast']);
Route::post('/receive', [PusherController::class, 'receive']);


/*
|--------------------------------------------------------------------------
| STUDENT ROUTE
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['role:student']], function () {

    // Profile
    Route::get('/students/profile', [StudentController::class, 'profile']);
    Route::post('/students/update', [StudentController::class, 'update']);

    // Logout
    Route::get('/students/logout', [StudentController::class, 'logout']);

});

/*
|--------------------------------------------------------------------------
| STAFF ROUTE
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['role:staff']], function () {

    // Dashboard
    Route::get('/staffs/dashboard', [StaffController::class, 'dashboard']);

    // Event
    Route::get('/staffs/events/viewEvent', [EventController::class, 'index']);

    // Student
    Route::get('/staffs/students/viewStudent', [StaffController::class, 'viewAllStud']);
    Route::get('/staffs/students/viewStudentSearch', [StaffController::class, 'searchStudent']);
    Route::get('/staffs/students/viewStudentDetail/{id}', [StaffController::class, 'viewStudDetail']);
    Route::delete('/staffs/students/deleteStud/{id}', [StaffController::class, 'deleteStud']);

    // Automated Chat
    Route::get('/staffs/chats/appointment/viewAppointment', [AppointmentController::class, 'index']);
    Route::get('/staffs/chats/complaint/viewComplaint', [ComplaintController::class, 'index']);
    Route::get('/staffs/chats/rating/viewRating', [ChatRatingController::class, 'index']);

    // Live Chat
    Route::get('/staffs/livechat', [StaffController::class, 'livechat']);

    // Profile
    Route::get('/staffs/profile', [StaffController::class, 'profile']);
    Route::post('/staffs/update', [StaffController::class, 'update']);

    // Logout
    Route::get('/staffs/logout', [StaffController::class, 'logout']);
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTE
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['role:admin']], function () {
    // Staff Register
    Route::get('/staffs/staffs/create', [StaffController::class, 'create']);
    Route::post('/staffs/staffs/register', [StaffController::class, 'store']);

    // Staff View
    Route::get('/staffs/staffs/viewStaff', [StaffController::class, 'index']);
    Route::get('/staffs/staffs/viewStaffSearch', [StaffController::class, 'searchStaff']);
    Route::delete('/staffs/staffs/destroy/{id}', [StaffController::class, 'destroy']);

});

//--------------HOMEPAGE ROUTE----------
// Main page
Route::get('/homepage', function () {
    return view('homepage');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/layout', function () {
    return view('layout');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/textGenerator', function () {
//     return view('textGenerator');
// });

//Route::resource('/event', EventController::class);
Route::post('/event', [EventController::class,'store']);
Route::get('/textGenerator?success={id}', [EventController::class, 'updateRemark']);

Route::get('/becomeorganizer', function () {
    $title = '';
    $content = '';
    return view('becomeorganizer', compact('title', 'content'));
});



Route::get('/textGenerator', function () {
    $title = '';
    $content = '';
    return view('textGenerator', compact('title', 'content'));
    });

Route::get('/event/search', [EventController::class, 'searchProducts']);



Route::post('/event/generate',[TextGeneratorController::class,'index']);
    