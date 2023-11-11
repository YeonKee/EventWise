<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::paginate(9);
        $appointmentsCount = $appointments->total();
        return view('staffs.chats.appointment.index', compact('appointments', 'appointmentsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        $email = $appointment->email;
        $title = $appointment->title;

        $appointment->delete();

        // send email
        MailController::cancelAppEmail($email, $title);

        Alert::success('Deleted!', 'An email has been sent to notify on cancelation.');

        return redirect()->back()->with('query', '');
    }

    /**
     * Approve appointment.
     */
    public function approveApp(Request $request)
    {
        $appointment = Appointment::find($request->app_id);

        if ($appointment->status == "Approved") {
            Alert::html('Already Approved!', 'This appointment has already been approved!');
        } else {
            $appointment->status = "Approved";
            $appointment->save();

            $email = $appointment->email;
            $title = $appointment->title;

            // send email
            MailController::approveAppEmail($email, $title);

            Alert::success('Approved!', 'An email has been sent to notify on approval.');
        }

        return redirect()->back();
    }

    /**
     * Put appointment to further discussion.
     */
    public function furtherDiscuss(Request $request)
    {
        $appointment = Appointment::find($request->app_id);

        if ($appointment->status == "Awaiting") {
            Alert::html('Already Awaiting!', 'This appointment has already in the state of awaiting!');
        } else {
            $appointment->status = "Awaiting";
            $appointment->save();

            $email = $appointment->email;
            $title = $appointment->title;

            // send email
            MailController::furtherDiscussEmail($email, $title);

            Alert::success('Awaiting!', 'An email has been sent to notify on awaiting approval from the individual.');
        }

        return redirect()->back();
    }

    public function searchAppointment(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $appointments = Appointment::where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('date', 'like', '%' . $query . '%')
                    ->orWhere('time', 'like', '%' . $query . '%')
                    ->orWhere('venue', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('status', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $appointments = Appointment::paginate(9);
        }

        $appointmentsCount = $appointments->total();
        return view('staffs.chats.appointment.index', compact('appointments', 'appointmentsCount'));
    }
}
