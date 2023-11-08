<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class TextGeneratorController extends Controller
{
    public function index(Request $request)
    {
    
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
    
}
