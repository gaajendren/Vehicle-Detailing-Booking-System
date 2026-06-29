<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\User;
use App\Models\services;
use App\Models\holidays;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Bookings::latest()->get();
        $staffs = User::where('role','Staff')->where('status','A')->latest()->get();
        $customers = User::where('role','Customer')->where('status','A')->latest()->get();
        $services = services::all();
        $holidays = holidays::select('holiday_name', 'holidays_date')->get();

        return view('Booking.index',compact('bookings','staffs','customers','services','holidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function assignstaff(Request $request)
    {
        $id = $request->input('id');

        $booking = Bookings::where('book_id',$id)->first();
        $booking->assigned = $request->input('assigned');
        $booking->booking_status = 'Assigned';
        $booking->save();

        return redirect()->back()->with('success', 'Staff has been assigned for the Job!');
    }

    public function approvebooking(Request $request)
    {
        $id = $request->input('booking_id');

        $booking = Bookings::where('book_id',$id)->first();
        $booking->booking_status = 'Approved';
        $booking->save();

        return response()->json(['success' => true]);
    }

    public function rejectbooking(Request $request)
    {
        $id = $request->input('booking_id');

        $booking = Bookings::where('book_id',$id)->first();
        $booking->booking_status = 'Rejected';
        $booking->save();

        return response()->json(['success' => true]);
    }

    public function deletebooking(Request $request)
    {
        $id = $request->input('booking_id');

        Bookings::where('book_id',$id)->delete();

        return response()->json(['success' => true]);
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

        return view('Booking.show',compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function progresstrack()
    {
        $bookings = Bookings::where('payment_status','Success')->latest()->get();

        return view('Booking.progresstrack',compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function storeBookingAdmin(Request $request)
    {
        $idbook = $request->input('idbook');
        $typebook = $request->input('typebook');



        if($typebook == 'Create'){
            $service = services::where('id',$request->input('service_id'))->first();

            $user = User::findOrFail($request->input('created_by'));
        $bookings = new Bookings;
        $bookings->service_id = $request->input('service_id');
        $bookings->name = $user->fullname;
        $bookings->email = $request->input('email');
        $bookings->phone = $request->input('phone');
        $bookings->address = $request->input('address');
        $bookings->book_date = $request->input('book_date');
        $bookings->book_timeslot = $request->input('book_timeslot');
        $bookings->remarks = $request->input('remarks');
        $bookings->payment_status =  $request->input('payment_status');
        $bookings->booking_status = $request->input('payment_status') == 'Success' ? 'Booking Confirmed' : 'Payment Failed';
        $bookings->total_price = $service->service_price;
        $bookings->created_by = $request->input('created_by');
        $bookings->updated_by = $request->input('created_by');
        $bookings->save();

        return redirect()->back()->with('success','Booking has been successfully created!');
        }
        else{
        $bookings = Bookings::where('book_id',$idbook)->first();
        $bookings->book_date = $request->input('book_date');
        $bookings->book_timeslot = $request->input('book_timeslot');
        $bookings->remarks = $request->input('remarks');
        $bookings->payment_status =  $request->input('payment_status');
        $bookings->booking_status = $request->input('payment_status') == 'Success' ? 'Booking Confirmed' : 'Payment Failed';
        $bookings->save();  

        return redirect()->back()->with('success','Booking has been successfully updated!');
        }

     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
