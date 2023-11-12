<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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

    public function Category(Request $request)
    {
        $events = Event::where('category', $request->category)->where('status','Approved')->get();
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

    public function searchEvents(Request $request)
    {
        if ($request->has('search')) {
            $events = Event::where('name', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->orWhere('category', 'LIKE', '%' . $request->search . '%')->get();
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
        $events->description = $request->event_desc;
        $events->acc_number = $request->pic_accNo;
        $events->bank_Name = $request->bank_Name_dropdown;
        $events->ticket_price = $request->event_price;
        $events->capacity = $request->event_capacity;
        $events->date = $request->event_date;
        $events->duration = $request->event_duration;
        $events->start_time = $request->event_startTime;
        $events->end_time = $request->event_endTime;
        $events->participated_count = 0;
        $events->remark = "";
        $events->event_picture = "";
        $events->event_venuearr = "";
        $events->status = "Pending";
        $events->registration_status = "Closed";
        $events->save();

        $request->session()->put('event_id', $events->event_id);

        $this->savePicture($request->event_pic, $events->event_id);
        $this->saveVenue($request->event_venueArr, $events->event_id);

        $events->event_picture = "/img/eventPicture/eventPicture_$events->event_id.png";
        $events->event_venuearr = "/img/venueArr/venueArr_$events->event_id.png";

        $events->save();
        return redirect('/textGenerator?success=' . $events->event_id);
        
    }

    public function updateRemark(Request $request, $eventId) {
        // Find the event by its ID
        $event = Event::find($eventId);
    
        if ($event) {
            // Update the 'status' column
            $event->update(['remark' =>$request->remark]);
            //return redirect('/textGenerator?success=' . $events->event_id);
    
            // Optionally, you can save the changes to the database
            // $event->save();
    
            // Return a response, redirect, or do other actions as needed
        } else {
            // Handle the case when the event is not found
        }
    
        // You can return a response or redirect to another page
    }

    public function registration(Request $request)
    {
        $registrations = new Registration();
        $registrations->event_id = $request->event_id;
        $registrations->stud_id = 1;
        $registrations->payment_method = 1;
        $registrations->receipt = "";
        $registrations->amount = $request->ticket_price;
        $registrations->part_name = $request->part_name;
        $registrations->part_contactNo = $request->part_ContactNo;
        $registrations->part_email = $request->part_email;
        $registrations->states = $request->part_States_dropdown;
        $registrations->address = $request->part_add;

        if($request->suggest == null){
            $registrations->suggest = 'No';
        }else{
            $registrations->suggest = 'Yes';
        }
        $registrations->save();

        $this->saveReceipt($request->part_receipt, $registrations->reg_id);

        $registrations->receipt = "/img/receipt/receipt_$registrations->reg_id.png";

        $registrations->save();
        //return redirect('/registerEvent?success=' . $registrations->reg_id);
        return redirect('/success');
        
    }

    public function viewAllEvent()
    {
        $events = Event::paginate(9);
        $eventsCount = $events->total();
        dd();
        return view('staffs.events.index', compact('events', 'eventsCount'));
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
                    ->orWhere('bank_Name', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $events = Event::paginate(9);
        }

        $eventsCount = $events->total();
        return view('staffs.events.index', compact('events', 'eventsCount'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
