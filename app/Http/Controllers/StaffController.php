<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use Carbon\Carbon;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Bookings::where('assigned',auth()->user()->id)->latest()->get();

        return view('Staff.index',compact('bookings'));
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
    public function show(string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();

        return view('Staff.show',compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function checkin(string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();

        $now = Carbon::now();
        $booking->checkin = Carbon::now();
        $booking->booking_status = 'In Progress';
        $booking->save();

        return redirect()->back()->with('success', "Checked IN on $now");
    }

    public function checkout(string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();

        if($booking->checkin == ''){
            return redirect()->back()->withErrors(['Checkin' => 'Please Checkin first before Checkout!']);
        }

        if($booking->jobdone_proof == ''){
            return redirect()->back()->withErrors(['Job Done Proof' => 'Please upload Job Done Proof before Checking Out!']);
        }

    

        $now = Carbon::now();
        $booking->checkout = Carbon::now();
        $booking->booking_status = 'Completed';
        $booking->save();

        return redirect()->back()->with('success', "Checked OUT on $now! This task has been Completed!");
    }

    public function uploadjobdone(Request $request, string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();

                // Check if a file has been uploaded
                if ($request->hasFile('jobdone_proof')) {
                    // Get the uploaded file
                    $image = $request->file('jobdone_proof');
                    
                    // Generate a unique filename for the image
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        
                    // Store the image in the public directory
                    $image->storeAs('jobdone', $filename);
        
                    // Save the image path to the database
                    $booking->jobdone_proof = $filename;
                }
        
                $booking->save();
        
                return redirect()->back()->with('success', 'Job Done Proof has been uploaded!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
