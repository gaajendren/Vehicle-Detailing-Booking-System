<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\UserCode;
use App\Models\User;

class TwoFAController extends Controller
{
  /**
     * Write code on Method
     *
     * @return response()
     */

   
    public function index()
    {
   
        return view('2fa');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
    
        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(2))
                        ->first();
    
        if ($find) {

            if (strcmp($find->code, $request->code) === 0) {
                Session::forget('user_2fa');

            if (auth()->user()->email_verified_at != null || auth()->user()->email_verified_at != '') {
    
                switch (auth()->user()->role) {
                    case 'Admin':
                        return redirect()->route('homeadmin');
                    case 'Customer':
                        return redirect()->route('homecustomer');
                    case 'Staff':
                        return redirect()->route('homestaff');
                    default:
                        return back()->with('error', 'Invalid user role.');
                }
                
            }
            else{
                $user = User::where('id', auth()->user()->id)->first();
                $user->sendEmailVerificationNotification();

                return redirect('/email/verify');
            }
            }
        }
    
        return back()->with('error', 'You entered the wrong code.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
        
        return back()->with('success', 'We sent you code on your email.');
    }

}
