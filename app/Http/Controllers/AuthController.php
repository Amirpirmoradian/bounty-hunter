<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm($seller = null)
    {
        // Auth::login(User::find(1));
        $user = auth()->user();
        if($user != null){
            switch($user->type){
                case 'admin':
                    return redirect('/admin');
                    break;
                case 'seller':
                    return redirect('/panel');
                    break;
                case 'client':
                    return redirect('/shop/');
                    break;
            }
                
        }
        $saloonName = null;
        if($seller != null){
            Cookie::queue('referred_by', $seller, 3600);
            if(User::where('username', $seller)->exists()){
                $saloonName = User::where('username', $seller)->first()->saloon_name;
            }
        }
        return view('auth.login', compact('saloonName'));
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
                'otp' => '???? ?????????? ???????? ???????? ?????? ???????????? ??????.'
            ]);
        } elseif ($httpcode == 200) {
            if (User::where('phone_number', $phoneNumber)->exists()) {
                $referredBy = null;
                if(Cookie::get('referred_by', false)){
                    if(User::where('username', Cookie::get('referred_by', false))->exists()){
                        $referredBy = User::where('username', Cookie::get('referred_by', false))->first()->id;
                    }
                }
                User::where('phone_number', $phoneNumber)->update([
                    'first_name'    => $response->result->userInfo->firstName,
                    'last_name'    => $response->result->userInfo->lastName,
                    'mootanroo_id'  => $response->result->userInfo->id,
                    'phone_number_verified_at'  => now(),
                    'referred_by'  => $referredBy,
                ]);
            } else {
                $referredBy = null;
                if(Cookie::get('referred_by', false)){
                    if(User::where('username', Cookie::get('referred_by', false))->exists()){
                        $referredBy = User::where('username', Cookie::get('referred_by', false))->first()->id;
                    }
                }
                User::create([
                    'phone_number' => $phoneNumber,
                    'first_name'    => $response->result->userInfo->firstName,
                    'last_name'    => $response->result->userInfo->lastName,
                    'mootanroo_id'  => $response->result->userInfo->id,
                    'phone_number_verified_at'  => now(),
                    'referred_by'  => $referredBy,
                    'type'  => 'customer',
                ]);
            }

            curl_close($ch);
            Auth::login(User::where('phone_number', $phoneNumber)->first());
            
            return redirect()->intended('panel');
        }
    }
}
