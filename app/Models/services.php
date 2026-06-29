<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    public $table = "services";
  
    protected $fillable = [
        'id', 'service_name', 'service_price', 'service_desc', 'service_status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
}
