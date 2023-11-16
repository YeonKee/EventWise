<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatMessageController;
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
use Facades\App\Facades\SessionManager;


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

// All links (easy testing)
Route::get('/easytest', function () {
    return view('easytest');
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
Route::get('/staffChat', [PusherController::class, 'staffIndex']);
Route::post('/broadcast', [PusherController::class, 'broadcast']);
Route::post('/receive', [PusherController::class, 'receive']);

// Automated Chat
Route::get('/set-layout', function () {
    $layout = request('layout');

    // Set a session variable to hold the selected layout
    session(['selected_layout' => $layout]);

    // Redirect back to the previous page or any desired page
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| STUDENT ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/students/eventHistory', [EventController::class, 'eventHistory']);
Route::group(['middleware' => ['role:student']], function () {

    // Profile
    Route::get('/students/profile', [StudentController::class, 'profile']);
    Route::post('/students/update', [StudentController::class, 'update']);

    // Logout
    Route::get('/students/logout', [StudentController::class, 'logout']);
 

});

//Route::get('/students/login', [StudentController::class, 'loginPage']);

// Route::get('/students/login', function () {
//     return SessionManager::showLogin();
// });
// Route::post('/students/login', function (Request $request) {
//     return SessionManager::doLogin($request);
// });

/*
|--------------------------------------------------------------------------
| STAFF ROUTE
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['role:staff']], function () {

    // Dashboard
    Route::get('/staffs/dashboard', [StaffController::class, 'dashboard']);

    // Event
    // Route::get('/staffs/events/viewEvent', [EventController::class, 'index']);
    Route::get('/staffs/events/viewEvent', [EventController::class, 'viewAllEvent']);
    Route::get('/staffs/events/staffEventSearch', [EventController::class, 'staffSearchEvents']);
    Route::get('/staffs/events/staffParticipantSearch', [EventController::class, 'staffSearchParticipants']);
    Route::get('/staffs/events/viewEventDetail/{id}', [EventController::class, 'viewEventDetail']);
    Route::get('/staffs/events/viewParticipantList', [EventController::class, 'viewParticipantList']);
    Route::get('/staffs/events/viewParticipantList/{id}', [EventController::class, 'participantList']);
    Route::post('/staffs/events/update/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/staffs/events/deleteEvent/{id}', [EventController::class, 'deleteEvent']);

    // Student
    Route::get('/staffs/students/viewStudent', [StaffController::class, 'viewAllStud']);
    Route::get('/staffs/students/viewStudentSearch', [StaffController::class, 'searchStudent']);
    Route::get('/staffs/students/viewStudentDetail/{id}', [StaffController::class, 'viewStudDetail']);
    Route::delete('/staffs/students/deleteStud/{id}', [StaffController::class, 'deleteStud']);

    // Automated Chat
    // Appointment
    Route::get('/staffs/chats/appointment/viewAppointment', [AppointmentController::class, 'index']);
    Route::get('/staffs/chats/appointment/viewAppointmentSearch', [AppointmentController::class, 'searchAppointment']);
    Route::post('/staffs/chats/appointment/approveApp', [AppointmentController::class, 'approveApp']);
    Route::post('/staffs/chats/appointment/furtherDiscuss', [AppointmentController::class, 'furtherDiscuss']);
    Route::delete('/staffs/chats/appointment/deleteApp/{id}', [AppointmentController::class, 'destroy']);

    // Compliant
    Route::get('/staffs/chats/complaint/viewComplaint', [ComplaintController::class, 'index']);
    Route::get('/staffs/chats/complaint/viewComplaintSearch', [ComplaintController::class, 'searchComplaint']);
    Route::delete('/staffs/chats/complaint/deleteComp/{id}', [ComplaintController::class, 'destroy']);

    // Rating
    Route::get('/staffs/chats/rating/viewRating', [ChatRatingController::class, 'index']);
    Route::get('/staffs/chats/rating/viewRatingSearch', [ChatRatingController::class, 'searchRating']);
    Route::delete('/staffs/chats/rating/deleteRating/{id}', [ChatRatingController::class, 'destroy']);

    // Live Chat
    Route::get('/staffs/livechat/{id}', [ChatMessageController::class, 'getChat']);
    Route::delete('/staffs/livechat/deleteChat/{id}', [ChatMessageController::class, 'destroy']);

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

Route::get('/homepage', [EventController::class, 'homepage']);
// Route::get('/homepage', function () {
//     return view('homepage');
// });

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

Route::resource('/events', EventController::class);
Route::post('/event', [EventController::class, 'store']);
Route::post('/event/register', [EventController::class, 'registration']);
Route::get('/textGenerator?success={id}', [EventController::class, 'updateRemark']);
Route::get('/registerEvent?success={id}', [EventController::class, 'registration']);


Route::get('/becomeorganizer', function () {
    $title = '';
    $content = '';
    return view('becomeorganizer', compact('title', 'content'));
});

Route::get('/venueArr', function () {
    return view('venueArr');
}); #

// Route::get('/staffs/events/index', function () {
//     return view('staffs.events.index');
// });

Route::get('/staffs/students/viewAllStud', function () {
    return view('staffs.students.viewAllStud');
});


Route::get('/success', function () {
    return view('success');
});


Route::get('/textGenerator', function () {
    $title = '';
    $content = '';
    return view('textGenerator', compact('title', 'content'));
});

Route::get('/event/viewByCategory/{category}', [EventController::class, 'Category']);
Route::get('/event/viewById/{id}', [EventController::class, 'viewById']);
Route::get('/event/search', [EventController::class, 'searchEvents']);
Route::get('/event/registerEvent/{id}', [EventController::class, 'registerEvent']);
Route::post('/event/generate', [TextGeneratorController::class, 'index']);
Route::post('/event/generate/update', [TextGeneratorController::class, 'updateRemark']);
Route::get('/event/suggestNearBy/{id}', [EventController::class, 'suggestNearBy']);



