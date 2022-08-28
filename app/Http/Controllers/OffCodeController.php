<?php

namespace App\Http\Controllers;

use App\Models\OffCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Kavenegar;
class OffCodeController extends Controller
{
    public function getOffcode(Request $request, $seller)
    {
        $user = auth()->user();
        if(User::where('username', $seller)->exists()){
            $seller = User::where('username', $seller)->first();
            if(OffCode::where('seller_id', $seller->id)->where('customer_id', $user->id)->exists()){
                $offcode = null;
                return view('offcode', compact('offcode'));
            }
            if(OffCode::where('seller_id', $seller->id)->where('used', false)->exists()){
                $offcode = OffCode::where('seller_id', $seller->id)->where('used', false)->first();
                $offcode->used = true;
                $offcode->customer_id = $user->id;
                $offcode->save();

                $user->referred_by = $seller->id;
                $user->save();
                
                try{
                    $result = Kavenegar::VerifyLookup($user->phone_number, $offcode->code, '', '', 'bounty-offcode');
                }catch(\Kavenegar\Exceptions\ApiException $e){
                    echo $e->errorMessage();
                }

                return view('offcode', compact('offcode'));
            }
        }
        return view('offcode');

        return abort(404, 'Not found');
    }
}
