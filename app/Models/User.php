<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Smsapi\Client\Curl\SmsapiHttpClient;
use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'number',
        'password',
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
    ];


    public function OTPCode()
    {
        $code = Str::random(5);
        Code::updateOrCreate([
            'user_id' => Auth::id(),
            'verification_code' => $code
            ]);

        $client = new SmsapiHttpClient();
        $service = $client->smsapiPlService(env('SMSAPI_TOKEN'));
        $message = SendSmsBag::withMessage(Auth::user()->number, 'Your activation code: '.$code);
        $message->from = "2Way";
        $service->smsFeature()->sendSms($message);
    }
}
