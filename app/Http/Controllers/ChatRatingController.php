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
        return view('staffs.chats.rating.index');
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
    public function destroy(Chat_Rating $chat_Rating)
    {
        //
    }
}
