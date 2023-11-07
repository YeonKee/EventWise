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

    /**
     * Store a newly created resource in storage.
     */
    private function getPicture($event_id)
    {
        if (file_exists(public_path("/img/eventPicture_$event_id.png"))) {
            $url = "/images/eventPicture_$event_id.png";
        } else {
            $url = '/img/default_eventpic.png';
        }

        return $url;
    }

    private function savePicture($file, $event_id)
    {
        Image::make($file)->fit(300)->save(public_path("/img/eventPicture_$event_id.png"));
    }

    private function deletePhoto($name)
    {
        File::delete(public_path("/photos/$name"));
    }



    public function store(Request $request)
    {

        $request->validate(
            [
                'event_personInCharge' => 'required|max:100',
                'event_picContactNo' =>  ['required', 'regex:/(\+?6?01)[0-46-9]-*[0-9]{7,8}/'],
                'pic_email' => ['required', 'regex:/^[A-Z0-9._%+-]+@([A-Z0-9-]+.){2,4}$/i'],
                'event_name' => 'required|max:100',
                'event_cat' => 'required',
                'other_category' => 'max:20',
                'event_desc' => 'required|max:300',
                'event_pic' => 'required', 
                'event_price' => ['required', 'regex:/^\d{1,3}(\.\d{2})?$/'],
                'pic_accNo' => ['required', 'regex:/^[0-9]*$/'],
                'event_capacity' => ['required', 'regex:/^([1-9]|[1-9][0-9]{0,2}|3000)$/'],
                'event_date' => 'required',
                'event_duration' => ['required', 'regex:/[1-5]/'],
                'event_startTime' => 'required',
                'event_endTime' => 'required',
                'event_remark' => 'required',
            ],
            [
                'event_personInCharge' => 'Empty field',
                'event_pic.required' => 'Empty field',
                'event_picContactNo.required' => 'Empty field',
                'pic_email.required' => 'Empty field',
                'event_name.required' => 'Empty field',
                'event_cat.required' => 'Empty field',
                'other_category' => 'Empty field',
                'event_desc.required' => 'Empty field',
                'event_price.required' => 'Empty field',
                'pic_accNo.required' => 'Empty field',
                'event_capacity.required' => 'Empty field',
                'event_date.required' => 'Empty field',
                'event_duration.required' => 'Empty field',
                'event_startTime.required' => 'Empty field',
                'event_endTime.required' => 'Empty field',
                'event_remark.required' => 'Empty field',
            ]
        );

        $events = new Event();
        $events->person_inCharge = $request->event_personInCharge;
        $events->contact_number = $request->event_picContactNo;
        $events->email = $request->pic_email;
        $events->name = $request->event_name;
        $events->category = $request->event_cat;
        $events->other_Cat = $request->other_category;
        $events->description = $request->event_desc;
        $events->acc_number = $request->pic_accNo;
        $events->ticket_price = $request->event_price;
        $events->capacity = $request->event_capacity;
        $events->date = $request->event_date;
        $events->duration = $request->event_duration;
        $events->start_time = $request->start_time;
        $events->end_time = $request->start_time;
        $events->participated_count = 0;
        $events->remark = "";
        $events->event_picture = "";
        $events->event_venuearr = "";
        $events->status = "Pending";
        $events->registration_status = "Closed";
        $events->save();

        $this->savePicture($request->prod_pic, $events->event_id);

        $events->prod_pic = "/img/eventPicture_$events->event_id.png";
        $venueData = $request->input('venueImage');
        //dd($venueData);

        // Decode the data URL and get the binary data
        $venueData = str_replace('data:image/png;base64,', '', $venueData);
        $venueData = str_replace(' ', '+', $venueData);
        $venueData = base64_decode($venueData);

        // Generate a unique filename
        $filename = 'venueArr_' . $events->event_id . '.png';

        // Define the path where you want to save the image
        $path = public_path('img/venueArr/' . $filename);

        // Save the image to the specified path
        file_put_contents($path, $venueData);

        $events->save();
        return redirect('/becomeorganizer?success=' . $events->event_id);
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
