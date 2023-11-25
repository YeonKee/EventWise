<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use RealRashid\SweetAlert\Facades\Alert;

class TextGeneratorController extends Controller
{
    public function index(Request $request)
    {
       // $event = Event::find($eventId);
    
        $title = $request->title;
    
        $result = OpenAI::completions()->create([
            "model" => "text-davinci-003",
            "temperature" => 0.7,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
            'prompt' => sprintf('Generate a full sentence for: %s', $title),
        ]);
    
        $content = trim($result['choices'][0]['text']);
    
        return view('textGenerator', compact('title', 'content'));
    }

    public function updateRemark(Request $request) {
        // Find the event by its ID


        $event= Event::where('event_id',$request->session()->get('event_id'))->first();
        //dd($event);
     
      //dd($request->remark);
    
        if ($event) {
            // Update the 'status' column
            $event->remark =$request->remark;
            $event->save();
            $request->session()->forget('event_id');

        
            Alert::html('Thank you for proposing the event. Stay tuned for the updates.');
            return redirect('/homepage');

    
            // Return a response, redirect, or do other actions as needed
        } else {
            // Handle the case when the event is not found
        }

        
    
        // You can return a response or redirect to another page
    }
    
}
