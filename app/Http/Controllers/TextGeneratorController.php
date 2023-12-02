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


        if ($title != null) {

            $result = OpenAI::completions()->create([
                "model" => "text-davinci-003",
                "temperature" => 0.7,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0,
                'max_tokens' => 600,
                 'prompt' => sprintf('Describe the event details and elaborate the details provided for: %s, and not more than 600 characters', $title),
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

        // Validate the request
        $validator = $request->validate([
            'description' => ['required', 'string', 'max:600'],
        ], [
            'description.required' => 'The description is required.',
            'description.max' => 'The description must not exceed 600 characters.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



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


        // // Find the event by its ID
        // $event = Event::where('event_id', $request->session()->get('event_id'))->first();


        // // dd($event);

        // if ($event) {
        //     // Update the 'status' column
        //     $event->description =$request->description;
        //     $event->save();
        //     $request->session()->forget('event_id');


        //     Alert::html('Thank you for proposing the event. Stay tuned for the updates.');
        //     return redirect('/homepage');


        //     // Return a response, redirect, or do other actions as needed
        // } else {
        //     // Handle the case when the event is not found
        // }

    }

}
