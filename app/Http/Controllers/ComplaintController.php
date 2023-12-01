<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::paginate(9);
        $complaintsCount = $complaints->total();
        return view('staffs.chats.complaint.index', compact('complaints', 'complaintsCount'));
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
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $complaint = Complaint::find($id);
        $complaint->delete();

        return redirect()->back()->with('query', '');
    }

    public function invalid(Request $request)
    {
        $complaint = Complaint::find($request->comp_id);
        $currentStaff = $request->session()->get("staffName");

        $complaint->status = "Invalid";
        $complaint->updated_by = $currentStaff;

        $complaint->save();

        Alert::success('Success!', 'This complaint has been marked as invalid.');

        return redirect()->back();
    }

    public function solved(Request $request)
    {
        $complaint = Complaint::find($request->comp_id);
        $currentStaff = $request->session()->get("staffName");

        $complaint->status = "Solved";
        $complaint->updated_by = $currentStaff;

        $complaint->save();

        Alert::success('Success!', 'This complaint has been marked as solved.');

        return redirect()->back();
    }

    public function searchComplaint(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $complaints = Complaint::where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%');
            })
                ->paginate(9);
        } else {
            $complaints = Complaint::paginate(9);
        }

        $complaintsCount = $complaints->total();
        return view('staffs.chats.complaint.index', compact('complaints', 'complaintsCount'));
    }
}
