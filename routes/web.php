<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatRatingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EventController;
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
Route::get('/update-database/{id}', [UpdateController::class, 'update'])->name('update.database');
// Route::get('/update-database/{id}', [UpdateController::class, 'update']);