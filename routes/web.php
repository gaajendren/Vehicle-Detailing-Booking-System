<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StaffController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['guest']], function () { 
Route::get('/', function () {
    return view('Auth.login');
})->name('/');

//Auth
Route::post('postloginusr',[AuthController::class, 'login'])->name('postloginusr');
Route::any('regusr',[AuthController::class, 'register'])->name('regusr');
Route::any('regusrwi',[AuthController::class, 'registerwi'])->name('regusrwi');

Route::post('postregisterusr',[AuthController::class, 'store']);
Route::post('postregisterusrwi',[AuthController::class, 'storewi']);

Route::get('forgotpass',[AuthController::class, 'forgotpass']);
Route::post('respass',[AuthController::class, 'respass']);
Route::get('resetpassword/{token}',[AuthController::class, 'resetpassword']);
Route::post('updatepassword',[AuthController::class, 'updatepassword']);

});

//2FA
Route::get('2fa',[TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa',[TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset',[TwoFAController::class, 'resend'])->name('2fa.resend');
Route::get('signout',[AuthController::class, 'signout'])->name('signout');
Route::get('signincustom',[AuthController::class, 'signincustom'])->name('signincustom');
Route::get('gettimeslots',[CustomerController::class, 'gettimeslots'])->name('gettimeslots');
Route::get('gettimeslotsedit',[CustomerController::class, 'gettimeslotsedit'])->name('gettimeslotsedit');


Route::middleware(['admin','verified'])->group(function () {
//Admin
Route::get('homeadmin',[AdminController::class, 'index'])->name('homeadmin');
Route::get('stafflist',[AdminController::class, 'stafflist'])->name('stafflist');
Route::post('storestaff',[AdminController::class, 'storestaff'])->name('storestaff');
Route::delete('deletestaff/{id}',[AdminController::class, 'destroy'])->name('deletestaff');

//Fullcalendar

Route::get('fetch-bookings',[AdminController::class, 'fetchbookings'])->name('fetch-bookings');
//Services
Route::get('services',[ServiceController::class, 'services'])->name('services');
Route::get('createservice',[ServiceController::class, 'createservice'])->name('createservice');
Route::post('storeservice',[ServiceController::class, 'storeservice'])->name('storeservice');
Route::any('deleteservice/{id}',[ServiceController::class, 'deleteservice'])->name('deleteservice');
Route::get('editservice/{id}',[ServiceController::class, 'editservice'])->name('editservice');
Route::put('updateservice/{service}', [ServiceController::class, 'updateservice'])->name('updateservice');
Route::get('viewservice/{id}',[ServiceController::class, 'viewservice'])->name('viewservice');

//Schedule
Route::get('schedule',[ScheduleController::class, 'index'])->name('schedule');
Route::get('getsch/{id}',[ScheduleController::class, 'indexsch'])->name('getsch');
Route::any('postschedule',[ScheduleController::class, 'postschedule'])->name('postschedule');
Route::post('storeschedule',[ScheduleController::class, 'storeschedule'])->name('storeschedule');
Route::any('deleteschedule/{id}',[ScheduleController::class, 'deleteschedule'])->name('deleteschedule');
Route::post('storeholidays',[ScheduleController::class, 'storeholidays'])->name('storeholidays');
Route::any('deleteholiday/{id}',[ScheduleController::class, 'deleteholiday'])->name('deleteholiday');


//Bookings
Route::get('bookings',[BookingController::class, 'index'])->name('bookings');
Route::get('fetchstaff',[AdminController::class, 'fetchstaff'])->name('fetchstaff');
Route::post('assignstaff',[BookingController::class, 'assignstaff'])->name('assignstaff');
Route::get('viewBooking/{id}',[BookingController::class, 'show'])->name('viewBooking');
Route::get('progresstrack',[BookingController::class, 'progresstrack'])->name('progresstrack');
Route::post('storebookingadmin',[BookingController::class, 'storeBookingAdmin'])->name('storebookingadmin');

Route::post('reject-booking',[BookingController::class, 'rejectbooking'])->name('reject-booking');
Route::post('approve-booking',[BookingController::class, 'approvebooking'])->name('approve-booking');
Route::any('delete-booking',[BookingController::class, 'deletebooking'])->name('delete-booking');

Route::get('fetch-bookings-byid',[AdminController::class, 'fetchbookingsbyid'])->name('fetch-bookings-byid');






//Holidays
Route::get('holidays',[ScheduleController::class, 'holidays'])->name('holidays');
});


Route::middleware(['customer','verified'])->group(function () {
//Customer
Route::get('homecustomer',[CustomerController::class, 'index'])->name('homecustomer');
Route::get('custservices',[CustomerController::class, 'services'])->name('custservices');
Route::get('contactus',[CustomerController::class, 'contactus'])->name('contactus');

Route::get('bookservice/{id}',[CustomerController::class, 'bookservice'])->name('bookservice');
Route::any('cancelBooking/{id}',[CustomerController::class, 'cancelBooking'])->name('cancelBooking');

Route::post('storebooking',[CustomerController::class, 'storebooking'])->name('storebooking');
Route::post('updbooking',[CustomerController::class, 'updbooking'])->name('updbooking');

Route::any('returnPayment/{id}',[CustomerController::class, 'returnPayment']);
Route::get('mybooking',[CustomerController::class, 'mybooking'])->name('mybooking');
Route::post('storereview',[CustomerController::class, 'storereview'])->name('storereview');
Route::get('editBooking/{id}',[CustomerController::class, 'editBooking'])->name('editBooking');

Route::get('myprofile',[CustomerController::class, 'myprofile'])->name('myprofile');
Route::any('updprofile',[CustomerController::class, 'updprofile'])->name('updprofile');
Route::any('changepass',[CustomerController::class, 'changepass'])->name('changepass');



});

Route::middleware(['staff','verified'])->group(function () {
//Staff
Route::get('homestaff',[StaffController::class, 'index'])->name('homestaff');
Route::get('viewTask/{id}',[StaffController::class, 'show'])->name('viewTask');
Route::get('checkin/{id}',[StaffController::class, 'checkin'])->name('checkin');
Route::get('checkout/{id}',[StaffController::class, 'checkout'])->name('checkout');
Route::put('uploadjobdone/{id}', [StaffController::class, 'uploadjobdone'])->name('uploadjobdone');
});






















Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
