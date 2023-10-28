<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatRatingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
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

// Route to homepage
Route::get('/', function () {
    return view('homepage');
});

// Student Navigation
// Register
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students/register', [StudentController::class, 'store']);
Route::get('/students/pendingEmailVerify', [StudentController::class, 'pendingVerify']);
Route::get('/students/successEmailVerify', [StudentController::class, 'successVerify']);

// Login
Route::get('/students/loginPage', [StudentController::class, 'loginPage']);
Route::post('/students/login', [StudentController::class, 'login']);

// Forget Password
Route::get('/students/resetPasswordEmail', [StudentController::class, 'resetPasswordEmail']);
Route::post('/students/getCode', [StudentController::class, 'getCode']);
Route::get('/students/resetPasswordPage', [StudentController::class, 'resetPasswordPage']);
Route::post('/students/resetPassword', [StudentController::class, 'resetPassword']);
Route::get('/students/successPasswordReset', [StudentController::class, 'successReset']);

// Profile
Route::get('/students/profile', [StudentController::class, 'profile']);
Route::post('/students/update', [StudentController::class, 'update']);

// All Staff Navigation
Route::get('/staffs/dashboard', [StaffController::class, 'dashboard'])->middleware('verified');
Route::get('/staffs/profile', [StaffController::class, 'profile']);
Route::get('/staffs/livechat', [StaffController::class, 'livechat']);

// Event
Route::get('/staffs/events/viewEvent', [EventController::class, 'index']);

// Student
Route::get('/staffs/students/viewStudent', [StudentController::class, 'index']);

// Staff
Route::get('/staffs/staffs/viewStaff', [StaffController::class, 'index']);
Route::get('/staffs/staffs/registerStaff', [StaffController::class, 'create']);

// Chat
Route::get('/staffs/chats/appointment/viewAppointment', [AppointmentController::class, 'index']);
Route::get('/staffs/chats/complaint/viewComplaint', [ComplaintController::class, 'index']);
Route::get('/staffs/chats/rating/viewRating', [ChatRatingController::class, 'index']);

// Email Verification
Route::get('/updateDatabaseEmailVerification/{studID}', [UpdateController::class, 'updateEmailVerification'])->name('update.database.verifyEmail');
Route::get('/verifyEmail/{email}/{studID}', [MailController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/resentVerifyEmail/{email}/{studID}', [MailController::class, 'resentVerifyEmail'])->name('resentVerifyEmail');

// Route::get('/update-database/{id}', [UpdateController::class, 'update']);