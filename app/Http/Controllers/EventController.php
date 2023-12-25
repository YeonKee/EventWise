<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Location;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("staffs.events.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function homepage(Request $request)
    {
        $events = Event::where('status', 'Approved')
            ->where('registration_status', 'Closed')
            ->where('event_status', 'Past');

        $upcoming = Event::where('event_status', 'Upcoming')
            ->where('status', 'Approved');

        // if (!$request->session()->has('studID')) {
        //     $events = $events->where('openFor', 'Public');
        // }

        if (!$request->session()->has('studID')) {
            $upcoming = $upcoming->where('openFor', 'Public');
        }

        // Get the current date and time
        $currentDateTime = Carbon::now();


        // Get the closest upcoming event
        $closestEvent = Event::where('event_status', 'Upcoming')
            ->where('date', '>=', $currentDateTime)
            ->orderBy('date')
            ->first();

        // Convert the 'date' field to a Carbon instance
        if ($closestEvent) {
            $closestEvent->date = Carbon::parse($closestEvent->date);
        }


        // Convert the 'date' field to a Carbon instance for each upcoming event
        foreach ($upcoming as $event) {
            $event->date = Carbon::parse($event->date);
        }

        $highestParticipationEvent = Event::where('status', 'Approved')
            ->orderBy('participated_count', 'desc')
            ->first();



        $events = $events->get();
        $upcoming = $upcoming->get();
        return view('homepage', ['events' => $events, 'upcoming' => $upcoming, 'closestEvent' => $closestEvent, 'highestParticipationEvent' => $highestParticipationEvent]);

    }


    public function Category(Request $request)
    {
        $events = Event::where('category', $request->category)->where('status', 'Approved')->where('event_status', 'Upcoming');

        if (!$request->session()->has('studID')) {
            $events = $events->where('openFor', 'Public');
        }

        $events = $events->get();
        return view('category', ['events' => $events]);

    }

    public function viewById(Request $request)
    {

        // if ($request->session()->has('user_id')) {
        //     $cust_id = $request->session()->get('user_id');
        //     $memberRank = Customer::where('cust_id', $cust_id)->first(['member_rank'])->member_rank;
        // }

        $event = Event::where('event_id', $request->id)->first();

        return view('show', ['event' => $event]);
    }


    public function eventHistory(Request $request)
    {
        $stud_id = $request->session()->get('studID');

        // Get the stud_id from the session
        //  $stud_id = Session::get('stud_id');
        //dd($stud_id);

        // Check if stud_id exists in the session
        if ($stud_id) {
            // Retrieve the registrations for the current student
            $registrations = Registration::where('stud_id', $stud_id)->get();

            // If you have relationships set up, you can eager load the events
            $registrations->load('event');

            return view('students.eventHistory', ['registrations' => $registrations]);
        }

        // Handle the case where stud_id is not present in the session
        return redirect()->route('/students/loginPage'); // Adjust the route as needed
    }


    public function searchEvents(Request $request)
    {
        if ($request->has('search')) {
            $query = Event::where('status', 'Approved')->where('event_status', 'Upcoming');

            if (!$request->session()->has('studID')) {
                // If there is no studID, show all approved and public events
                $query->where('openFor', 'Public');
            }

            // If they have entered something, search according to the input
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('category', 'LIKE', '%' . $request->search . '%');
            });

            $events = $query->get();

            return view('category', ['events' => $events]);
        } else {
            return view('homepage');
        }
    }

    public function registerEvent(Request $request)
    {
        $event = Event::where('event_id', $request->id)->first();

        return view('registerEvent', ['event' => $event]);
    }


    private function getPicture($event_id)
    {
        if (file_exists(public_path("/img/eventPicture/eventPicture_$event_id.png"))) {
            $url = "/img/eventPicture/eventPicture_$event_id.png";
        } else {
            $url = '/img/default_eventpic.png';
        }

        return $url;
    }

    private function savePicture($file, $event_id)
    {
        Image::make($file)->fit(300)->save(public_path("/img/eventPicture/eventPicture_$event_id.png"));
    }

    private function saveVenue($file, $event_id)
    {
        Image::make($file)->fit(300)->save(public_path("/img/venueArr/venueArr_$event_id.png"));
    }

    private function saveReceipt($file, $reg_id)
    {
        Image::make($file)->fit(300)->save(public_path("/img/receipt/receipt_$reg_id.png"));
    }

    private function saveQR($file, $event_id)
    {
        Image::make($file)->fit(300)->save(public_path("/img/paymentQR/paymentQR_$event_id.png"));
    }


    // private function saveVenue($file, $event_id)
    // {
    //     Image::make($file)->fit(300)->save(public_path("/img/venueArr/venueArr_$event_id.png"));
    // }


    private function deletePhoto($name)
    {
        File::delete(public_path("/photos/$name"));
    }


    public function store(Request $request)
    {
        $events = new Event();
        $events->person_inCharge = $request->event_personInCharge;
        $events->contact_number = $request->event_picContactNo;
        $events->email = $request->pic_email;
        $events->name = $request->event_name;
        $events->category = $request->event_cat_dropdown;
        $events->openFor = $request->open_For_dropdown;
        $events->description = "";

        if ($request->event_price == 0.00) {
            $events->acc_number = "";
            $events->bank_Name = "no_bank_selected";
            $events->payment_qr = "";
        }else{
            $events->acc_number = $request->pic_accNo;
            $events->bank_Name = $request->bank_Name_dropdown;
        }

      
        $events->ticket_price = $request->event_price;
        $events->capacity = $request->event_capacity;
        $events->date = $request->event_date;
        $events->duration = $request->event_duration;
        $events->start_time = $request->event_startTime;
        $events->end_time = $request->event_endTime;
        $events->participated_count = 0;
        $events->remark = $request->event_remark;
        $events->event_picture = "";
        $events->event_venuearr = "";
        $events->status = "Pending";
        $events->registration_status = "Closed";
        $events->event_status = "Upcoming";
        $events->save();

        $request->session()->put('event_id', $events->event_id);

        $this->savePicture($request->event_pic, $events->event_id);
        $this->saveVenue($request->event_venueArr, $events->event_id);
        if ($request->event_price != 0.00) {
            $this->saveQR($request->payment_qr, $events->event_id);
        }
        $events->event_picture = "/img/eventPicture/eventPicture_$events->event_id.png";
        $events->event_venuearr = "/img/venueArr/venueArr_$events->event_id.png";
        $events->payment_qr = "/img/paymentQR/paymentQR_$events->event_id.png";

        $events->save();
        return redirect('/textGenerator?success=' . $events->event_id);

    }

    public function updateDescription(Request $request, $eventId)
    {
        // Find the event by its ID
        $event = Event::find($eventId);

        if ($event) {
            // Update the 'remark' column
            $event->update(['description' => $request->description]);
        }




        // You can return a response or redirect to another page
    }

    // public function generateLocation(Request $request)
    // {
    //     $address = $request->part_add;

    //     if ($address) {
    //         $result = OpenAI::completions()->create([
    //             "model" => "text-davinci-003",
    //             "temperature" => 0.7,
    //             "top_p" => 1,
    //             "frequency_penalty" => 0,
    //             "presence_penalty" => 0,
    //             'max_tokens' => 600,
    //             'prompt' => sprintf('Generate longitude and latitude for this address with the most accurate answer: %s', $address),
    //         ]);

    //         // Check if the response contains the expected data
    //         if (isset($result['choices'][0]['text']) && isset($result['choices'][1]['text'])) {
    //             $content1 = trim($result['choices'][0]['text']);
    //             $content2 = trim($result['choices'][1]['text']);

    //             // Debugging: dd to see which one is longitude and which one is latitude
    //             dd("This is longitude: %s", $content1, "This is latitude: %s", $content2);

    //             // Use a View::share to make variables available to all views
    //             View::share('generatedLocation', [
    //                 'longitude' => $content1,
    //                 'latitude' => $content2,
    //             ]);

    //             return redirect('/event/registerEvent');
    //         } else {
    //             // Handle the case when the response does not contain the expected data
    //             return redirect()->route('your.route.name')->withErrors(['address' => 'Unable to generate location.']);
    //         }
    //     } else {
    //         // If address is null, redirect back with an error
    //         return redirect()->route('your.route.name')->withErrors(['address' => 'Address is required.']);
    //     }
    // }


    public function registration(Request $request)
    {


        $add = $request->part_add;

        if ($add != null) {
            $result = OpenAI::completions()->create([
                "model" => "text-davinci-003",
                "temperature" => 0.7,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0,
                'max_tokens' => 600,
                'prompt' => sprintf('Generate longitude and latitude for this address with the most accurate answer from google maps: %s, the answer should be latitude first and follwed by longitude', $add),
            ]);

            $content1 = $result['choices'][0]['text'] ?? null;

            list($latitude, $longitude) = explode(',', $content1);

            //dd($latitude);
            //dd($longitude);
            // Use a View::share to make variables available to all views
            // View::share('generatedLocation', [
            //     'latitude' => $latitude,
            //     'longitude' => $longitude,
            // ]);
        }

        // Check if the email is already registered for the event
        $existingRegistration = Registration::where('event_id', $request->event_id)
            ->where('part_email', $request->part_email)
            ->exists();

        if ($existingRegistration == "true") {

            Alert::html('Seems like you have been resgister for this event!', 'Email: (<b>' . e($request->part_email) . '</b>) is found in database.');

            return redirect()->back();
        }

        $registrations = new Registration();
        $registrations->event_id = $request->event_id;
        $registrations->payment_method = 1;
        $registrations->receipt = "";
        $registrations->amount = $request->ticket_price;
        $registrations->part_name = $request->part_name;
        $registrations->part_contactNo = $request->part_ContactNo;
        $registrations->part_email = $request->part_email;
        // $registrations->states = $request->part_States_dropdown;
        // $registrations->city = $request->part_city;
        $registrations->address = $request->part_add;
        $registrations->longitude = $longitude;
        $registrations->latitude = $latitude;

        if ($request->session()->has('studID')) {
            $registrations->stud_id = $request->session()->get('studID');
        } else {
            $registrations->stud_id = 1;
        }

        if ($request->suggest == null) {
            $registrations->suggest = 'No';
        } else {
            $registrations->suggest = 'Yes';
        }
        $registrations->save();

        if ($request->event_price != 0.00) {
            $this->saveReceipt($request->part_receipt, $registrations->reg_id);
        }

        $registrations->receipt = "/img/receipt/receipt_$registrations->reg_id.png";

        $registrations->save();
        $request->session()->put('reg_id', $registrations->reg_id);

        $event = Event::find($request->event_id);

        if ($event) {
            $event->participated_count += 1;
            $event->save();
        }

        if ($event->participated_count == $event->capacity) {
            $event->registration_status = "Closed";
            $event->save();
        }


        //return redirect('/registerEvent?success=' . $registrations->reg_id);
        return redirect('/success?success=' . $registrations->reg_id);


    }

    public function viewAllEvent()
    {
        $events = Event::paginate(9);
        $eventsCount = $events->total();
        return view('staffs.events.index', compact('events', 'eventsCount'));
    }

    public function viewParticipantList()
    {
        $events = Event::paginate(9);
        $eventsCount = $events->total();
        return view('staffs.events.viewParticipantList', compact('events', 'eventsCount'));
    }

    public function participantList($id)
    {
        // Get all participants for the given event_id
        $participantList = Registration::where('event_id', $id)->paginate(9);

        // Get the total number of participants
        $totalParticipants = $participantList->total();
        $event = Event::where('event_id', $id)->first();

        return view('staffs.events.participantList')->with(['participantList' => $participantList, 'totalParticipants' => $totalParticipants, 'event' => $event]);
    }

    public function suggestNearParticipants($referenceParticipant, $participants)
    {
        $suggestedParticipants = $participants->filter(function ($participant) use ($referenceParticipant) {
            // Check if the participant agreed to display info
            if ($participant->suggest !== 'Yes') {
                return false;
            }

            // Calculate distance between participants using their latitude and longitude
            $distance = $this->calculateDistance(
                $referenceParticipant->latitude,
                $referenceParticipant->longitude,
                $participant->latitude,
                $participant->longitude
            );

            // Check if the distance is within 10 km
            return $distance <= 10;
        });

        return $suggestedParticipants;
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth radius in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function suggestNearBy($id)
    {
        // Find the participant by its ID
        $participant = Registration::find($id);

        $stud_id = session('studID');
        $student = Student::find($stud_id);


        // Get the event for the participant
        $event = Event::find($participant->event_id);

        // Get all participants for the given event_id excluding the current participant
        $participantList = Registration::where('event_id', $event->event_id)
            ->where('reg_id', '!=', $id)
            ->where('suggest', '=', 'Yes')
            ->whereNotNull('latitude') // Assuming you have latitude and longitude columns
            ->whereNotNull('longitude')
            ->paginate(9);

        // Suggest nearby participants based on address, city, state, and agreement to display info
        $suggestedParticipants = $this->suggestNearParticipants($participant, $participantList);

        return view('suggestNearBy')->with([
            'participantList' => $participantList,
            'event' => $event,
            'suggestedParticipants' => $suggestedParticipants,
            'senderName' => $student,
        ]);
    }

    public function staffSearchEvents(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $events = Event::where(function ($q) use ($query) {
                $q->where('event_id', 'like', '%' . $query . '%')
                    ->orWhere('person_inCharge', 'like', '%' . $query . '%')
                    ->orWhere('contact_number', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('ticket_price', 'like', '%' . $query . '%')
                    ->orWhere('capacity', 'like', '%' . $query . '%')
                    ->orWhere('participated_count', 'like', '%' . $query . '%')
                    ->orWhere('start_time', 'like', '%' . $query . '%')
                    ->orWhere('end_time', 'like', '%' . $query . '%')
                    ->orWhere('duration', 'like', '%' . $query . '%')
                    ->orWhere('status', 'like', '%' . $query . '%')
                    ->orWhere('remark', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%')
                    ->orWhere('updated_at', 'like', '%' . $query . '%')
                    ->orWhere('category', 'like', '%' . $query . '%')
                    ->orWhere('registration_status', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('acc_number', 'like', '%' . $query . '%')
                    ->orWhere('openFor', 'like', '%' . $query . '%')
                    ->orWhere('event_status', 'like', '%' . $query . '%')
                    ->orWhere('bank_Name', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $events = Event::paginate(9);
        }

        $eventsCount = $events->total();
        return view('staffs.events.index', compact('events', 'eventsCount'));
    }

    // public function staffViewParticipantSearch(Request $request)
    // {
    //     $query = $request->input('query');

    //     if ($query) {
    //         $events = Registration::where(function ($q) use ($query) {
    //             $q->where('event_id', 'like', '%' . $query . '%')
    //                 ->orWhere('stud_id', 'like', '%' . $query . '%')
    //                 ->orWhere('part_name', 'like', '%' . $query . '%')
    //                 ->orWhere('part_contactNo', 'like', '%' . $query . '%')
    //                 ->orWhere('part_email', 'like', '%' . $query . '%')
    //                 ->orWhere('address', 'like', '%' . $query . '%');
        
    //         })
    //             ->paginate(9);
    //     } else {
    //         $events = Registration::paginate(9);
    //     }

    //     $eventsCount = $events->total();
    //     return view('staffs.events.viewParticipantList', compact('events', 'eventsCount'));
    // }

    public function staffSearchParticipants(Request $request)
    {
        $query = $request->input('query');
    
        if ($query) {
            $participantList = Registration::where(function ($q) use ($query) {
                $q->where('registrations.event_id', 'like', '%' . $query . '%')
                    ->orWhere('part_name', 'like', '%' . $query . '%')
                    ->orWhere('part_ContactNo', 'like', '%' . $query . '%')
                    ->orWhere('part_email', 'like', '%' . $query . '%');
            })
            ->join('events', 'registrations.event_id', '=', 'events.event_id')
            ->select('registrations.*', 'events.name')
            ->paginate(9);
    
            // Get the total number of participants for the given query
            $totalParticipants = $participantList->total();
        } else {
            // If no search query, fetch all participants with event names
            $participants = Registration::join('events', 'registrations.event_id', '=', 'events.id')
                ->select('registrations.*', 'events.name')
                ->paginate(9);
        }
    
        return view('staffs.events.searchResult', compact('participantList', 'totalParticipants'));
    }
    

    public function viewEventDetail($id)
    {
        $event = Event::where('event_id', $id)->first();
        return view('staffs.events.viewEventDetail')->with(['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->back();
    }

    public function contactByEmail(Request $request)
    {
        $validators = [
            'name' => 'required|max:100',
            'email' => 'required|max:50|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
            'phone' => 'required|max:12|regex:/^[0-9]*$/',
            'messages' => 'required|max:300'
        ];

        $errMsgs = [
            'name.required' => 'Name should not be empty.',
            'name.max' => 'Name should only be 100 characters long.',
            'email.required' => 'Email should not be empty.',
            'email.max' => 'Email should only be 50 characters long.',
            'email.regex' => 'Email should follow the pattern: [...@gmail.com].',
            'phone.required' => 'Phone should not be empty.',
            'phone.max' => 'Phone should only be 12 characters long.',
            'phone.regex' => 'Phone should follow the pattern: [0133506462].',
            'messages.required' => 'Message should not be empty.',
            'messages.max' => 'Message should only be 300 characters long.',
        ];

        $request->validate($validators, $errMsgs);
        MailController::contactByEmail($request->name, $request->email, $request->phone, $request->messages);
        Alert::html('The message has been sent to EventWise. Stay tuned for the updates.');
        return redirect()->back();
    }




    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {


        $event->person_inCharge = $request->event_personInCharge;
        $event->contact_number = $request->event_picContactNo;
        $event->email = $request->pic_email;
        $event->name = $request->event_name;
        $event->category = $request->event_cat_dropdown;
        $event->openFor = $request->open_For_dropdown;
        $event->description = $request->event_desc;
        $event->acc_number = $request->pic_accNo;
        $event->bank_Name = $request->bank_Name_dropdown;
        $event->ticket_price = $request->event_price;
        $event->capacity = $request->event_capacity;
        $event->date = $request->event_date;
        $event->duration = $request->event_duration;
        $event->start_time = $request->event_startTime;
        $event->end_time = $request->event_endTime;
        $event->participated_count = 0;
        $event->remark = $request->remark;
        $event->status = $request->approval_status_dropdown;
        $event->registration_status = $request->registration_status_dropdown;
        $event->event_status = $request->event_status_dropdown;

        if ($request->hasFile('event_pic')) {
            $this->savePicture($request->event_pic, $event->event_id);
        }


        if ($request->hasFile('event_venueArr')) {
            $this->saveVenue($request->event_venueArr, $event->event_id);
        }

        if ($request->hasFile('payment_qr')) {
            $this->saveQR($request->payment_qr, $event->event_id);
        }


        $event->save();

        Alert::success('Updated Successfully!', 'The event information has been updated.');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
