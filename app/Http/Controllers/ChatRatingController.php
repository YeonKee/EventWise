<?php

namespace App\Http\Controllers;

use App\Models\Chat_Rating;
use Illuminate\Http\Request;

class ChatRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chatRatings = Chat_Rating::paginate(9);
        $chaRatingsCounts = $chatRatings->total();

        $totalRatings = Chat_Rating::sum('ratings');
        $averageRatings = number_format($totalRatings / ($chaRatingsCounts * 5) * 100, 2);

        return view('staffs.chats.rating.index', compact('chatRatings', 'chaRatingsCounts', 'averageRatings'));
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
    public function show(Chat_Rating $chat_Rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat_Rating $chat_Rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat_Rating $chat_Rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $chatRating = Chat_Rating::find($id);
        $chatRating->delete();

        return redirect()->back()->with('query', '');
    }

    public function searchRating(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $chatRatings = Chat_Rating::where(function ($q) use ($query) {
                $q->where('ratings', 'like', '%' . $query . '%')
                    ->orWhere('remarks', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $chatRatings = Chat_Rating::paginate(9);
        }

        // Calculate average score
        $allChats = Chat_Rating::paginate(9);
        $allChatsCount = $allChats->total();
        $totalRatings = Chat_Rating::sum('ratings');
        $averageRatings = number_format($totalRatings / ($allChatsCount * 5) * 100, 2);

        $chaRatingsCounts = $chatRatings->total();
        return view('staffs.chats.rating.index', compact('chatRatings', 'chaRatingsCounts', 'averageRatings'));

    }
}
