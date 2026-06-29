<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking_schedule;
use App\Models\services;
use App\Models\holidays;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = services::latest()->get();

        return view('Schedule.subindex',compact('services'));
    }

    public function indexsch($id)
    {
        $schedules = booking_schedule::where('service_id',$id)->get();

        $service = services::where('id',$id)->first();

        return view('Schedule.index',compact('schedules','service','id'));
    }

    

    public function postschedule(Request $request)
    {
        $id = $request->input('service');
    

        return redirect("getsch/$id");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeschedule(Request $request)
    {
        //check existing
        $getsch = booking_schedule::where('service_id',$request->input('id'))
        ->where('schedule_time',$request->input('schedule_time'))
        ->count();

     

        if($getsch <= 0){

        $sch = new booking_schedule;
        $sch->schedule_time = $request->input('schedule_time');
        $sch->service_id = $request->input('id');
        $sch->save();

        return redirect()->back()->with('success', 'Schedule has been saved!');
        }
        else{
        return redirect()->back()->with('errors', 'Schedule already exist! Please select another Time.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function deleteschedule(string $id)
    {
        booking_schedule::findOrFail($id)->delete();

        return redirect('schedule')->with('success', 'Schedule has been deleted!');
    }

    public function deleteholiday(string $id)
    {
        holidays::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Holidays has been deleted!');
    }

    

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function holidays()
    {
        $holidays = holidays::latest()->get();

        return view('Holidays.index',compact('holidays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function storeholidays(Request $request)
    {
        //check existing
        $getholiday = holidays::where('holidays_date',$request->input('holidays_date'))
        ->count();

        
        if($getholiday <= 0){

        $hly = new holidays;
        $hly->holiday_name = $request->input('holiday_name');
        $hly->holidays_date = $request->input('holidays_date');
        $hly->save();

        return redirect()->back()->with('success', 'Holidays has been saved!');
        }
        else{
        return redirect()->back()->with('errors', 'Holidays already exist! Please select another Date.');
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
