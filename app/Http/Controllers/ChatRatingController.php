<?php

namespace App\Http\Controllers;

use App\Models\Chat_Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chatRatings = Chat_Rating::orderBy('created_at', 'desc')->paginate(9);
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
            })->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $chatRatings = Chat_Rating::orderBy('created_at', 'desc')->paginate(9);
        }

        // Calculate average score
        $allChats = Chat_Rating::paginate(9);
        $allChatsCount = $allChats->total();
        $totalRatings = Chat_Rating::sum('ratings');
        $averageRatings = number_format($totalRatings / ($allChatsCount * 5) * 100, 2);

        $chaRatingsCounts = $chatRatings->total();
        return view('staffs.chats.rating.index', compact('chatRatings', 'chaRatingsCounts', 'averageRatings'));
    }

    public function ratingScoreMonthly(Request $request)
    {
        // $allMonths = [
        //     'January' => 'N/A',
        //     'February' => 'N/A',
        //     'March' => 'N/A',
        //     'April' => 'N/A',
        //     'May' => 'N/A',
        //     'June' => 'N/A',
        //     'July' => 'N/A',
        //     'August' => 'N/A',
        //     'September' => 'N/A',
        //     'October' => 'N/A',
        //     'November' => 'N/A',
        //     'December' => 'N/A',
        // ];

        $averageRatings = Chat_Rating::selectRaw('MONTH(created_at) as month, SUM(ratings) as sum_rating, COUNT(*) as total_count')
            ->whereYear('created_at', $request->year)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        $totalRating = Chat_Rating::whereYear('created_at', $request->year)->count();

        // foreach ($averageRatingsByMonth as $avg) {
        //     $monthNumber = $avg->month;
        //     $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1)); 

        //     if ($avg->sum_rating > 0) {
        //         $allMonths[$monthName] = number_format(($avg->sum_rating / ($avg->total_count * 5)) * 100, 2);
        //     } else {
        //         $allMonths[$monthName] = 'N/A';
        //     }
        // }

        return view('staffs.chats.rating.ratingScore', compact('totalRating', 'averageRatings'));
    }

    public function ratingScoreYearly(Request $request)
    {
        $averageRatings = Chat_Rating::selectRaw('YEAR(created_at) as year, SUM(ratings) as sum_rating, COUNT(*) as total_count')
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        $totalRating = Chat_Rating::get()->count();

        return view('staffs.chats.rating.ratingScore', compact('totalRating', 'averageRatings'));
    }
}
