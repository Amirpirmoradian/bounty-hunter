<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    



    public function index(Request $request)
    {
        return view('panel.index');
    }

    public function referrals(Request $request)
    {
        $seller = auth()->user();
        $referrals = User::where('referred_by', $seller->id)->get();
        return view('panel.referrals', compact('referrals'));

    }
}
