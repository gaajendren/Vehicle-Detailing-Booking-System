<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Model
{
    public $table = "Bookings";

    protected $primaryKey = 'book_id';

    use HasFactory;
    use SoftDeletes;

    public function getbooking()
    {
        return $this->belongsTo('App\Models\services', 'service_id');
    }

    public function getsch()
    {
        return $this->belongsTo('App\Models\booking_schedule', 'book_timeslot')->withTrashed();
    }

    public function getstaff()
    {
        return $this->belongsTo('App\Models\User', 'assigned');
    }


    

}
