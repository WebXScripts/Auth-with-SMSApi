<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SMSAuthController extends Controller
{
    public function index()
    {
        return view('2fa');
    }

    public function store(Request $request)
    {
        $check = $request->validate([
            'code' => 'required',
        ]);

        $exists = Code::where('user_id', Auth::user()->id)
            ->where('verification_code', $check['code'])
            ->where('updated_at', '>=', now()->subMinutes(5))->exists();

        if ($exists) {
            Session::put('tfa', auth()->user()->id);
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'You entered wrong code.');
    }

    public function resend()
    {
        Auth::user()->OTPCode();
        return back()->with('success', 'We have resent OTP on your mobile number.');
    }


}
