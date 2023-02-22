<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomAudioController extends Controller
{
    public function uploadCustomAudioFile(Request $request)
    {
        $user_id = auth()->user()->id;
        dd($user_id);
    }
}
