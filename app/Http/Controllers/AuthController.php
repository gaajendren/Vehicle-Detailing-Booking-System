<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Validation\Rule;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Initialize variables to store extracted information
        $name = '';
        $validity = '';
        $ic = '';
        $address = '';
        $licencefile = '';

        // Check if a file named 'licence_file' exists in the request
        if ($request->hasFile('licence_file')) {

            // Get the file from the request
            $file = $request->file('licence_file');

            // // Store the file in the 'temp' directory
            // $filePath = $file->store('licence');

            // // Create an image instance from the stored file
            // $image = Image::make('uploads/' . $filePath);

            // // Sharpen the image
            // $image->sharpen(2);

            // $licencefile = $filePath;


            // // Get the directory path of the stored file
            // $directoryPath = pathinfo(('uploads/' . $filePath), PATHINFO_DIRNAME);


            // // Define the path for the sharpened image
            // $sharpenedImagePath = $directoryPath . '/sharpened_image.jpg';

            // // Save the sharpened image
            // $image->save($sharpenedImagePath);



            // // Initialize TesseractOCR instance with the path to the sharpened image
            // $tesseract = new TesseractOCR($sharpenedImagePath);

            // // Set the language for OCR to English
            // $tesseract->lang('eng');

            try {
                // Run OCR on the image and extract text
                //$text = $tesseract->run();
            } catch (\Exception $e) {
                // If OCR fails, redirect back with an error message
                return redirect()->back()->withErrors([
                    'errors' => 'Unable to read from the uploaded image. Please try again! <br> If you want to Register without Licence please <a href="regusrwi">click here</a>'
                ]);
            }

            // Split the extracted text into lines
            $textLines = explode("\n", $text);

            // Remove empty lines
            $textLines = array_filter($textLines);

            // Reset array keys to start from 0
            $textLines = array_values($textLines);

            // Convert array to collection
            $textCollection = collect($textLines);

            // Count the total number of items in the collection
            $totalItems = $textCollection->count();

            // Search for the line containing 'MALAYSIA'
            $keyContainingMalaysia = $textCollection->search(function ($line) {
                return strpos($line, 'MALAYSIA') !== false;
            });

            // Extract name if 'MALAYSIA' is found
            if ($keyContainingMalaysia !== false) {
                $name = $textCollection[$keyContainingMalaysia + 1];
            } else {
                $name = '';
            }

            // Search for the line containing 'Warganegara'
            $keyContainingWarganegara = $textCollection->search(function ($line) {
                return strpos($line, 'Warganegara') !== false;
            });

            // Extract IC number if 'Warganegara' is found
            if ($keyContainingWarganegara !== false) {
                $line = $textCollection[$keyContainingWarganegara + 1];
                $ic = str_replace('MALAYSIA ', '', $line);
            } else {
                $ic = '';
            }

            // Search for the line containing 'Validity'
            $keyContainingValidity = $textCollection->search(function ($line) {
                return strpos($line, 'Validity') !== false;
            });

            // Extract validity if 'Validity' is found
            if ($keyContainingValidity !== false) {
                $validity = $textCollection[$keyContainingValidity + 1];
            } else {
                $validity = '';
            }

            // Search for the line containing 'Address'
            $keyContainingAddress = $textCollection->search(function ($line) {
                return strpos($line, 'Address') !== false;
            });

            // Extract address if 'Address' is found
            if ($keyContainingAddress !== false) {
                $address = '';
                for ($i = $keyContainingAddress + 1; $i < $totalItems; $i++) {
                    $address .= $textCollection[$i] . ' ';
                }
            } else {
                $address = '';
            }

            // If all extracted information is empty, redirect back with an error message
            if ($name == '' && $ic == '' && $validity == '' && $address == '') {
                return redirect()->back()->withErrors([
                    'errors' => 'Unable to read from the uploaded image. Please try again! <br> If you want to Register without Licence please <a href="regusrwi">click here</a>'
                ]);
            }
        }

        // Pass extracted information to the registration view
        return view('Auth.register', compact('name', 'ic', 'validity', 'address', 'licencefile'));
    }


    public function registerwi(Request $request)
    {

        return view('Auth.registerwi');
    }

    public function store(Request $request)
    {
        $fullname = $request->input('fullname');
        $mykad = $request->input('mykad');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $licence_validity = $request->input('licence_validity');
        $address = $request->input('address');
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');

        //check unique
        $emailcheck = User::where('email', $email)->count();
        $checkmykad = User::where('mykad', $mykad)->count();


        if ($emailcheck > 0) {
            return redirect()->back()->withErrors(['errors' => 'Email already exist']);
        } else if ($checkmykad > 0) {
            return redirect()->back()->withErrors(['errors' => 'IC Number Already Exist!']);
        } else if ($password != $cpassword) {
            return redirect()->back()->withErrors(['errors' => 'Password does not match with confirm password!']);
        } else {

            $rules = [
                'mykad' => 'required|string|regex:/^\d{12}$/',
                'phone' => ['required', 'string', 'regex:/^\+60(12|11|16|14|18)-\d{7,8}$/'],
                'password' => ['required', 'string', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}$/'],
            ];

            $messages = [
                'mykad.regex' => 'MyKad number must be exactly 12 digits.',
                'phone.regex' => 'Phone number must follow the format +6099-99999999.',
                'password.regex' => 'Your password must be between 10 - 32 characters long and include an uppercase letter (A-Z), a lowercase letter (a-z), a number (0-9), and a special character such as @$!%*#?&.',
            ];


            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User;
            $user->fullname = $fullname;
            $user->mykad = $mykad;
            $user->email = $email;
            $user->phone = $phone;
            $user->licence_validity = $licence_validity;
            $user->address = $address;
            $user->password = Hash::make($password);
            $user->role = 'Customer';
            $user->status = 'A';
            $user->updated_at = Carbon::now();
            $user->save();



            return redirect('/')->with('success', 'Register Success! Please login to your Account.');
        }
    }

    public function storewi(Request $request)
    {
        $fullname = $request->input('fullname');
        $mykad = $request->input('mykad');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');

        //check unique
        $emailcheck = User::where('email', $email)->count();
        $checkmykad = User::where('mykad', $mykad)->count();


        if ($emailcheck > 0) {
            return redirect()->back()->withErrors(['errors' => 'Email already exist']);
        } else if ($checkmykad > 0) {
            return redirect()->back()->withErrors(['errors' => 'IC Number Already Exist!']);
        } else if ($password != $cpassword) {
            return redirect()->back()->withErrors(['errors' => 'Password does not match with confirm password!']);
        } else {
            $rules = [
                'mykad' => 'required|string|regex:/^\d{12}$/',
                'phone' => ['required', 'string', 'regex:/^\+60(12|11|16|14|18)-\d{7,8}$/'],
                'password' => ['required', 'string', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}$/'],
            ];

            $messages = [
                'mykad.regex' => 'MyKad number must be exactly 12 digits.',
                'phone.regex' => 'Phone number must follow the format +6099-99999999.',
                'password.regex' => 'Your password must be between 10 - 32 characters long and include an uppercase letter (A-Z), a lowercase letter (a-z), a number (0-9), and a special character such as @$!%*#?&.',
            ];


            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



            $user = new User;
            $user->fullname = $fullname;
            $user->mykad = $mykad;
            $user->email = $email;
            $user->phone = $phone;
            $user->address = $address;
            $user->password = Hash::make($password);
            $user->role = 'Customer';
            $user->status = 'A';
            $user->updated_at = Carbon::now();
            $user->save();



            return redirect('/')->with('success', 'Register Success! Please login to your Account.');
        }
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);


        $credentials = $request->only('email', 'password', 'role');


        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {


            if (auth()->user()->role === $credentials['role']) {


                if (auth()->user()->locked_datetime != null && Carbon::parse(auth()->user()->locked_datetime)->isPast() == false) {

                    $lockedDateTime = Carbon::parse(auth()->user()->locked_datetime);

                    // Calculate the remaining time in minutes and seconds
                    $remainingMinutes = Carbon::now()->diffInMinutes($lockedDateTime);
                    $remainingSeconds = Carbon::now()->diffInSeconds($lockedDateTime);

                    // Extract whole minutes and remaining seconds
                    $minutes = floor($remainingMinutes);
                    $seconds = $remainingSeconds % 60;

                    // Construct the message
                    $message = "Whoops! Your Account has been temporarily disabled. ";
                    if ($minutes > 0) {
                        $message .= "Please try again after $minutes minute";
                        if ($minutes > 1) {
                            $message .= "s"; // Pluralize "minute" if needed
                        }
                        if ($seconds > 0) {
                            $message .= " and $seconds second";
                            if ($seconds > 1) {
                                $message .= "s"; // Pluralize "second" if needed
                            }
                        }
                    } else {
                        $message .= "Please try again after $seconds second";
                        if ($seconds > 1) {
                            $message .= "s"; // Pluralize "second" if needed
                        }
                    }
                    auth()->logout();

                    return redirect("/")->withErrors($message);
                } else {

                        User::where('id', auth()->user()->id)->update([
                            'attempt' => 0,
                            'locked_datetime' => NULL
                        ]);

                        $user = auth()->user();

                        if (in_array($user->role, ['Admin', 'Staff'])) {

                            return match ($user->role) {
                                'Admin' => redirect()->route('homeadmin'),
                                'Staff' => redirect()->route('homestaff'),
                            };

                        }

                        // only Customer goes 2FA
                        Session::put('user_2fa', $user->id);
                        $user->generateCode();

                        return redirect()->route('2fa.index');
                }
            } else {

                Auth::logout();
                return redirect("/")->withErrors('Whoops! Incorrect role selected');
            }
        } else {
            $checkifemailexist = User::where('email', $credentials['email'])->first();

            if ($checkifemailexist != '') {
                $currentattempt = $checkifemailexist->attempt + 1;

                if ($currentattempt < 5) {
                    $checkifemailexist->attempt = $checkifemailexist->attempt + 1;
                    $checkifemailexist->locked_datetime = NULL;
                } else if ($currentattempt == 5) {
                    $checkifemailexist->attempt = 5;

                    $checkifemailexist->locked_datetime = Carbon::now()->addMinutes(2);
                } else if ($checkifemailexist->attempt == 5 && Carbon::parse($checkifemailexist->locked_datetime)->isPast() == true) {
                    $checkifemailexist->attempt = 1;
                    $checkifemailexist->locked_datetime = NULL;
                }
                $checkifemailexist->save();
            }


            $recheck = User::where('email', $credentials['email'])->first();
            $lockedDateTime = Carbon::parse($recheck->locked_datetime);


            if ($recheck->locked_datetime != null && $lockedDateTime->isPast() == false) {

                $lockedDateTime = Carbon::parse($recheck->locked_datetime);

                $remainingMinutes = Carbon::now()->diffInMinutes($lockedDateTime);
                $remainingSeconds = Carbon::now()->diffInSeconds($lockedDateTime);

                $minutes = floor($remainingMinutes);
                $seconds = $remainingSeconds % 60;

                $message = "Whoops! Your Account has been temporarily disabled. ";
                if ($minutes > 0) {
                    $message .= "Please try again after $minutes minute";
                    if ($minutes > 1) {
                        $message .= "s";
                    }
                    if ($seconds > 0) {
                        $message .= " and $seconds second";
                        if ($seconds > 1) {
                            $message .= "s";
                        }
                    }
                } else {
                    $message .= "Please try again after $seconds second";
                    if ($seconds > 1) {
                        $message .= "s";
                    }
                }
                
                return redirect("/")->withErrors($message);
            } else {
                return redirect("/")->withErrors('Whoops! You have entered invalid credentials');
            }
        }
    }


    public function signout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function signincustom()
    {
        switch (auth()->user()->role) {
            case 'Admin':
                return redirect()->route('homeadmin')->with('success', 'Email has been verified!');
            case 'Customer':
                return redirect()->route('homecustomer')->with('success', 'Email has been verified!');
            case 'Staff':
                return redirect()->route('homestaff')->with('success', 'Email has been verified!');
            default:
                return back()->with('error', 'Invalid user role.');
        }
    }




    public function forgotpass()
    {
        return view('Auth.forgotpass');
    }

    public function respass(Request $request)
    {
        $email = $request->input('email');

        $getuser = User::where('email', $email)->first();

        $token = Str::random(100);

        $expirydate = Carbon::now()->addHour(1);

        $url = request()->getSchemeAndHttpHost() . '/resetpassword' . '/' . $token;

        if ($getuser == '') {
            return redirect()->back()->with('error', 'Invalid Email, Please try again!');
        } else {
            $getuser->reset_password_token = $token;
            $getuser->reset_expiry_datetime = $expirydate;
            $getuser->save();

            \Mail::to($getuser->email)->send(new \App\Mail\resetpass($getuser->fullname, $url));

            return redirect('/')->with('success', "Password reset link has been sent to $getuser->email!");
        }
    }

    public function resetpassword($token)
    {

        $user = User::where('reset_password_token', $token)->first();

        if ($user == '') {
            return redirect('/')->with('error', 'Invalid Password Reset Request!');
        }

        $nowDate = Carbon::now();
        $result = $nowDate->gt($user->reset_expiry_datetime);

        if ($result == true) {
            return redirect('/forgotpass')->with('error', 'Password reset link has been expired! Please request new Password reset!');
        }

        return view('Auth.resetpassword', compact('user'));
    }

    public function updatepassword(Request $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');
        $repassword = $request->input('repassword');

        if ($password != $repassword) {
            return redirect()->back()->with('error', 'The Password and Re Password does not match!');
        }

        $user = User::where('id', $id)->first();

        $user->reset_password_token = NULL;
        $user->reset_expiry_datetime = NULL;
        $user->password = Hash::make($password);
        $user->save();

        return redirect('/')->with('success', 'Password has been updated! Please login to your account!');
    }
}
