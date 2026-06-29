<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Bookings;
use App\Models\services;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // Get the current month
      $currentMonth = Carbon::now()->month;

      // Query the bookings for the current month
      $totalbooking = Bookings::count();

      $totalincome = Bookings::whereMonth('book_date', $currentMonth)
      ->where('payment_status','Success')
      ->whereIn('booking_status', ['Booking Confirmed','Completed','Assigned','Approved'])
      ->sum('total_price');

      $totalservices = services::count();

      $totalstaff = User::where('role','Staff')->count();

      return view('Admin.index',compact('totalbooking','totalincome','totalstaff','totalservices'));
    }

    public function stafflist()
    {
        $staffs = User::where('role','Staff')->latest()->get();

        return view('Admin.users',compact('staffs'));
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return redirect()->back()->with('success', 'Staff has been successfully deleted!');
    }

    public function fetchbookings()
    {
        $data = Bookings::leftJoin('booking_schedule', 'Bookings.book_timeslot', '=', 'booking_schedule.schedule_id')
        ->leftJoin('services', 'Bookings.service_id', '=', 'services.id')
        ->where('payment_status', 'Success')
        ->where('Bookings.booking_status','!=','Cancelled')
        ->orderBy('Bookings.created_at', 'desc')
        ->get(['Bookings.*', 'booking_schedule.*', 'services.*'])
        ->map(function ($booking) {
            if (!empty($booking->schedule_time) && is_numeric($booking->service_hours)) {
                $newTime = Carbon::parse($booking->schedule_time)->addHours($booking->service_hours)->format('H:i:s');
                $booking->new_schedule_time = $newTime;
            }
            return $booking;
        });
    


        return response()->json($data);
    }

    public function fetchbookingsbyid(Request $request)
    {
        $id = $request->id;

        $data = Bookings::where('book_id',$id)->first();
    
        return response()->json($data);
    }

    

    public function fetchstaff(Request $request)
    {
        $bookdate = $request->bookdate;
        $booktime = $request->booktime;
    
        $fetchrelated = Bookings::join('booking_schedule', 'Bookings.book_timeslot', '=', 'booking_schedule.schedule_id')
            ->where('payment_status', 'Success')
            ->whereDate('Bookings.book_date', $bookdate)
            ->where('Bookings.booking_status','!=','Cancelled')
            ->where('booking_schedule.schedule_time', $booktime)
            ->pluck('Bookings.assigned')
            ->filter()
            ->unique()
            ->values();

        $data = User::where('role', 'Staff')
            ->whereNotIn('id', $fetchrelated ?? [])
            ->get();
    
        return response()->json($data);
    }

    

    

    

    

    /**
     * Remove the specified resource from storage.
     */
    public function storestaff(Request $request)
    {
        //fetchtype
        $id = $request->input('id');
        $type = $request->input('type');

        if($type == 'C'){
        //check duplicate
        $checkemail = User::where('email',$request->input('email'))->count();
        $checkstaffid = User::where('staffid',$request->input('staffid'))->count();
        $checkmykad = User::where('mykad',$request->input('mykad'))->count();

        if($checkemail > 0){
            return redirect()->back()->withErrors(['email' => 'Email already exists! Please try with a different email.']);

        }

        if($checkstaffid > 0){
            return redirect()->back()->withErrors(['Staff ID' => 'Staff ID already exists! Please try with a different Staff ID.']);
        }

        if($checkmykad > 0){
            return redirect()->back()->withErrors(['IC Number' => 'IC Number already exists! Please try with a different IC Number.']);
        }

        $staff = new User;
        $staff->fullname = $request->input('fullname');
        $staff->email = $request->input('email');
        $staff->phone = $request->input('phone');
        $staff->mykad = $request->input('mykad');
        $staff->staffid = $request->input('staffid');
        $staff->role = 'Staff';
        $staff->status = $request->input('status');
        $staff->password = Hash::make($request->input('password'));
        $staff->save();

        return redirect()->back()->with('success', 'Staff has been successfully saved!');
        }
        else{

        //check duplicate
        $checkemail = User::where('email',$request->input('email'))->count();
        $checkstaffid = User::where('staffid',$request->input('staffid'))->count();
        $checkmykad = User::where('mykad',$request->input('mykad'))->count();

        $staff = User::where('id',$id)->first();

        if($checkemail > 0 && $staff->email != $request->input('email')){
            return redirect()->back()->withErrors(['email' => 'Email already exists! Please try with a different email.']);
        }

        if($checkstaffid > 0 && $staff->staffid != $request->input('staffid')){
            return redirect()->back()->withErrors(['Staff ID' => 'Staff ID already exists! Please try with a different Staff ID.']);
        }

        if($checkmykad > 0 && $staff->mykad != $request->input('mykad')){
            return redirect()->back()->withErrors(['IC Number' => 'IC Number already exists! Please try with a different IC Number.']);
        }


        $staff->fullname = $request->input('fullname');
        $staff->email = $request->input('email');
        $staff->phone = $request->input('phone');
        $staff->staffid = $request->input('staffid');
        $staff->mykad = $request->input('mykad');
        $staff->role = 'Staff';
        $staff->status = $request->input('status');

        if($request->input('password') != ''){
        $staff->password = Hash::make($request->input('password'));
        }

        $staff->save();

        return redirect()->back()->with('success', 'Staff has been successfully updated!');
        }
    }
}
