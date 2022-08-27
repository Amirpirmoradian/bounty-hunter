<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showVerifyForm(VerifyRequest $request)
    {
        $phoneNumber = $request->phone_number;
        $data = [
            'mobile' => $phoneNumber
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://mootanroo.com/api/v2/users/request-otp");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return view('auth.verify', compact('phoneNumber'));
    }


    public function login(LoginRequest $request)
    {

        $phoneNumber = $request->input('phone_number');
        $data = [
            "username" => $phoneNumber,
            "password" => $request->input('otp'),
            "client_id" => "app",
            "client_secret" => "app",
            "scope" => "global",
            "grant_type" => "password"
        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://mootanroo.com/api/v2/sessions");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch));
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode == 400) {
            return redirect()->back()->withErrors([
                'otp' => 'کد یکبار مصرف وارد شده اشتباه است.'
            ]);
        } elseif ($httpcode == 200) {
            if (User::where('phone_number', $phoneNumber)->exists()) {
                $user = User::where('phone_number', $phoneNumber)->update([
                    'first_name'    => $response->result->userInfo->firstName,
                    'last_name'    => $response->result->userInfo->lastName,
                    'mootanroo_id'  => $response->result->userInfo->id,
                    'phone_number_verified_at'  => now()
                ]);
            } else {
                $user = Customers::create([
                    'phone_number' => $phoneNumber,
                    'first_name'    => $response->result->userInfo->firstName,
                    'last_name'    => $response->result->userInfo->lastName,
                    'mootanroo_id'  => $response->result->userInfo->id,
                    'phone_number_verified_at'  => now()
                ]);
            }

            curl_close($ch);
            Auth::login(User::where('phone_number', $phoneNumber)->first());

            
            return redirect()->route('panel');
        }
    }
}
