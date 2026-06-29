<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;
use App\Models\Bookings;
use App\Models\booking_schedule;
use App\Models\holidays;
use App\Models\Toyyibpay;
use Carbon\Carbon;
use Auth;
use Illuminate\Validation\Rule;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Customer.index');
    }

    public function myprofile()
    {
        return view('Customer.profile');
    }

    
    
    public function contactus()
    {
        return view('Customer.contact');
    }

    

    public function mybooking()
    {
        $bookings = Bookings::where('created_by',auth()->user()->id)->latest()->get();

        return view('Customer.mybooking',compact('bookings'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function services()
    {
        $services = services::latest()->get();

        return view('Customer.services',compact('services'));
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
    public function bookservice(string $id)
    {
        $service = services::where('id',$id)->first();

        $holidays = holidays::select('holiday_name', 'holidays_date')->get();

        return view('Customer.bookservice',compact('service','id','holidays'));
    }

    public function editBooking(string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();

        $service = services::where('id',$booking->service_id)->first();

        $holidays = holidays::select('holiday_name', 'holidays_date')->get();

        return view('Customer.editbooking',compact('service','id','holidays','booking'));
    }




    public function updprofile(Request $request){

    $checkmykad = User::where('mykad', $request->input('mykad'))->count();


    if ($checkmykad > 0 && $request->input('mykad') != auth()->user()->mykad) {
        return redirect()->back()->withErrors(['errors' => 'IC Number Already Exist!']);
    } else {
        $rules = [
            'mykad' => 'required|string|regex:/^\d{12}$/',
            'phone' => ['required', 'string', 'regex:/^\+60(12|11|16|14|18)-\d{7,8}$/']
        ];

        $messages = [
            'mykad.regex' => 'MyKad number must be exactly 12 digits.',
            'phone.regex' => 'Phone number must follow the format +6099-99999999.'
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::findOrFail(auth()->user()->id);
        $user->fullname = $request->input('fullname');
        $user->mykad =$request->input('mykad');
        $user->phone = $request->input('phone');
        $user->licence_validity = $request->input('licence_validity') ? $request->input('licence_validity') : NULL;
        $user->address = $request->input('address');
        $user->updated_at = Carbon::now();
        $user->save();

        return redirect()->back()->with('success','Profile has been updated!');
    }
}


public function changepass(Request $request){

    $cpassword = $request->input('cpassword');
    $newpassword = $request->input('newpassword');
    $cnewpassword = $request->input('cnewpassword');

    $user = User::findOrFail(auth()->user()->id);

    if(Hash::check($cpassword, $user->password)){
    if ($newpassword != $cnewpassword) {
        return redirect()->back()->withErrors(['errors' => 'New Password and Confirm Password Does Not Match!']);
    } else {
        $rules = [
            'newpassword' => ['required', 'string', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}$/'],
            'cnewpassword' => ['required', 'string', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}$/'],
        ];

        $messages = [
            'newpassword.regex' => 'Your New Password must be between 10 - 32 characters long and include an uppercase letter (A-Z), a lowercase letter (a-z), a number (0-9), and a special character such as @$!%*#?&.',
            'cnewpassword.regex' => 'Your Confirm New Password must be between 10 - 32 characters long and include an uppercase letter (A-Z), a lowercase letter (a-z), a number (0-9), and a special character such as @$!%*#?&.'
        ];


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($newpassword);
        $user->updated_at = Carbon::now();
        $user->save();

        return redirect()->back()->with('success','Password has been updated!');
    }
}else{
    return redirect()->back()->withErrors(['errors' => 'Invalid Current Password!']);
}
}

    public function gettimeslots(Request $request)
    {
        $date = $request->date;
        $id = $request->id;
    
        $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    
        // Retrieve all timeslots that have been booked twice or more for the given date and service
        $checkexisting = Bookings::whereDate('book_date', $formattedDate)
                                 ->where('service_id', $id)
                                 ->where('booking_status', 'Booking Confirmed')
                                 ->groupBy('book_timeslot')
                                 ->havingRaw('COUNT(*) >= 2')
                                 ->pluck('book_timeslot');
    
        // Fetch available timeslots that are not already fully booked for the given date and service
        $data = booking_schedule::whereNotIn('schedule_id', $checkexisting)
                               ->where('service_id', $id)
                               ->orderBy('schedule_time')
                               ->get();
    
        return response()->json($data);
    }

    public function gettimeslotsedit(Request $request)
    {
        $date = $request->date;
        $id = $request->id;
        $cid = $request->cid;

        $getbooking = Bookings::where('book_id', $cid)->first();
    
        $formattedDate = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    

        if($formattedDate == $getbooking->book_date){
        // Retrieve all timeslots that have been booked twice or more for the given date and service
        $checkexisting = Bookings::whereDate('book_date', $formattedDate)
                                 ->where('service_id', $id)
                                 ->where('book_id','!=', $cid)
                                 ->whereIn('booking_status', ['Booking Confirmed','Approved'])
                                 ->groupBy('book_timeslot')
                                 ->havingRaw('COUNT(*) >= 2')
                                 ->pluck('book_timeslot');
    
        // Fetch available timeslots that are not already fully booked for the given date and service
        $data = booking_schedule::whereNotIn('schedule_id', $checkexisting)
                               ->where('service_id', $id)
                               ->orderBy('schedule_time')
                               ->get();

      
    
        return response()->json(['data' => $data,'timeslot' => $getbooking->book_timeslot]);
        }
        else{
        // Retrieve all timeslots that have been booked twice or more for the given date and service
        $checkexisting = Bookings::whereDate('book_date', $formattedDate)
                                 ->where('service_id', $id)
                                 ->groupBy('book_timeslot')
                                 ->havingRaw('COUNT(*) >= 2')
                                 ->whereIn('booking_status', ['Booking Confirmed','Approved'])
                                 ->pluck('book_timeslot');
    
        // Fetch available timeslots that are not already fully booked for the given date and service
        $data = booking_schedule::whereNotIn('schedule_id', $checkexisting)
                               ->where('service_id', $id)
                               ->orderBy('schedule_time')
                               ->get();

                               return response()->json(['data' => $data,'timeslot' => '']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */

     

     public function updbooking(Request $request)
     {
 
         $service = services::where('id',$request->input('id'))->first();
 
         $bookings = Bookings::where('book_id',$request->input('cid'))->first();
         $bookings->updated_by = auth()->user()->id;
         $bookings->book_date = $request->input('book_date');
         $bookings->book_timeslot = $request->input('book_timeslot');
         $bookings->remarks = $request->input('remarks');
         $bookings->save();

         return redirect("mybooking")->with('success','Booking has been successfully saved!');
     }


    public function storebooking(Request $request)
    {

        $service = services::where('id',$request->input('id'))->first();

        $bookings = new Bookings;
        $bookings->service_id = $request->input('id');
        $bookings->name = $request->input('name');
        $bookings->email = $request->input('email');
        $bookings->phone = $request->input('phone');
        $bookings->address = $request->input('address');
        $bookings->book_date = $request->input('book_date');
        $bookings->book_timeslot = $request->input('book_timeslot');
        $bookings->remarks = $request->input('remarks');
        $bookings->payment_status = 'Pending';
        $bookings->booking_status = 'Pending for Payment';
        $bookings->total_price = $service->service_price;
        $bookings->created_by = auth()->user()->id;
        $bookings->updated_by = auth()->user()->id;
        $bookings->save();

        $toyyibpay_secret_key = 'iln200e6-zt83-1xqf-dsl8-lmkbhg258irg';
        $category_code = 'h3qe5lbt';
        $paymentGateway = new ToyyibPay($toyyibpay_secret_key);

        $baseurl = 'http://vehicle-detailing-booking-system.test';

        $id = $bookings->book_id;

        $bill = $paymentGateway->createBill( $category_code, $bookings->name, $service->service_name, $id )
                                ->payer( $bookings->name, $bookings->email, $bookings->phone)
                                ->amount( $service->service_price )
                                ->chargeToCustomer( 2 )
                                ->callbackUrl( "{$baseurl}/returnPayment/$id")
                                ->emailContent( 'Thank you for your Payment!' );
        
                                echo $bill->redirectToPaymentUrl();
    }

    public function storereview(Request $request) {
        $id = $request->input('id');

        $booking = Bookings::where('book_id',$id)->first();
        $booking->booking_review = $request->input('booking_review');
        $booking->save();

        return redirect("mybooking")->with('success','Booking review has been successfully updated!');
    }

    public function returnPayment($id,Request $request)
    {

    $booking = Bookings::where('book_id',$id)->first();
    $booking->payment_status = $request->status_id == 1 ? 'Success' : 'Failed';
    $booking->booking_status = $request->status_id == 1 ? 'Booking Confirmed' : 'Payment Failed';
    $booking->transaction_id = $request->transaction_id;
    $booking->billcode = $request->billcode;
    $booking->save();

    if( $request->status_id == 1){

    $url = request()->getSchemeAndHttpHost();

    if($booking->payment_status == "Success"){
    
    // \Mail::to(auth()->user()->email)->send(new \App\Mail\bookingConfirmation($booking,$url));
    
    return redirect("mybooking")->with('success','Booking has been successfully saved!');
    }
    else{
    return redirect('mybooking')->withErrors(['errors' => 'Payment has been failed !']);
    }
    
    }
    else{
        return redirect('mybooking')->withErrors(['errors' => 'Payment has been failed !']);
    }
    }

    public function cancelBooking(Request $request, string $id)
    {
        $booking = Bookings::where('book_id',$id)->first();
        $booking->booking_status = 'Cancelled';
        $booking->save();

        return redirect("mybooking")->with('success','Booking has been successfully Cancelled!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
