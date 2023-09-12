<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatRatingController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'verify' => true
]);

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




Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  
/* New Added Routes */
Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']); 
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify'); 



// Staff
Route::get('/staffs/staffs/viewStaff', [StaffController::class, 'index']);
Route::get('/staffs/staffs/registerStaff', [StaffController::class, 'create']);

// Chat
Route::get('/staffs/chats/appointment/viewAppointment', [AppointmentController::class, 'index']);
Route::get('/staffs/chats/complaint/viewComplaint', [ComplaintController::class, 'index']);
Route::get('/staffs/chats/rating/viewRating', [ChatRatingController::class, 'index']);