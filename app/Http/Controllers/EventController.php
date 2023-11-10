<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
