<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Mail\SendCodeMail;
use Exception;
use Mail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'fullname', 'mykad', 'email', 'licence_validity', 'address', 'status', 'phone', 'password', 'role', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function generateCode()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
        
        $randomCode = substr(str_shuffle($characters), 0, 6);
    
        $mykad = auth()->user()->mykad;
        $mykadFirstPart = substr($mykad, 0, 2);
        $mykadLastPart = substr($mykad, -2);
    
        $firstPart = substr($randomCode, 0, 2);
        $middlePart = substr($randomCode, 2, 2);
        $lastPart = substr($randomCode, 4, 2);
        
        $code = $firstPart . $mykadFirstPart . $middlePart . $mykadLastPart . $lastPart;
    
        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );
    
        try {
            $details = [
                'title' => 'VDBS 2FA',
                'code' => $code
            ];
    
            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
    
}
