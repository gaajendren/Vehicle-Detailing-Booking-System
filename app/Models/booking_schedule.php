<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class booking_schedule extends Model
{
    use SoftDeletes;
    
    public $table = "booking_schedule";

    protected $primaryKey = 'schedule_id';
}
