<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class TextGeneratorController extends Controller
{
    public function index(Request $request)
    {
        // $event = Event::find($eventId);

        $title = $request->title;
        $event = $request->event_id;

        if ($event) {
            // Retrieve the event from the database
            $events = Event::find($event);

            // Check if the event is found
            if ($events) {
                // Access the event properties
                $eventName = $events->name;
                $ticketPrice = $events->ticket_price;
                $duration = $events->duration;
                $capacity = $events->capacity;
                $date = $events->date;
                $category = $events->category;
                $startTime = $events->start_time;
                $endTime = $events->end_time;

            } else {
                // Event not found
                dd("Event not found");
            }
        } else {
            // Event ID not provided
            dd("Event ID not provided");
        }

        if ($title != null) {

            $result = OpenAI::completions()->create([
                "model" => "text-davinci-003",
                "temperature" => 0.7,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0,
                'max_tokens' => 600,
                'prompt' => sprintf('Describe the event details and elaborate the details provided for: %s, which is based on the event 
                 information:Event Name:%s,Ticket Price:%s,Event Duration(days):%s,Capacity:%s,Event Date%s, Event Category:%s,Event start time:%s, 
                 Event end time:%s, and not more than 600 characters',
                    $title, $eventName, $ticketPrice, $duration, $capacity, $date, $category, $startTime, $endTime),
                //'prompt' => sprintf('Generate longitude and latitude for this address with most accurate answer: %s', $title),
            ]);

            $content = trim($result['choices'][0]['text']);
        } else {
            $validators = [
                'event_description' => 'required|max:255',

            ];

            $errMsgs = [
                'event_description.required' => 'Description should not be empty.',
                'event_description.max' => 'Description should only be 255 characters long.',
            ];

            $validated = $request->validate($validators, $errMsgs);

        }


        return view('textGenerator', compact('title', 'content'));
    }

    public function updateDescription(Request $request)
    {

        // Find the event by its ID
        $event = Event::where('event_id', $request->session()->get('event_id'))->first();

        if ($event) {
            // Update the 'description' column
            $event->description = $request->description;
            $event->save();
            $request->session()->forget('event_id');

            Alert::html('Thank you for proposing the event. Stay tuned for the updates.');
            return redirect('/homepage');
        } else {
            // Handle the case when the event is not found
            // You might want to redirect back with an error message or handle it accordingly
        }



    }

}
