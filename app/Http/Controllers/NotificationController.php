<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FCMService;

class NotificationController extends Controller
{
    public function sendTest(Request $request, FCMService $fcm)
    {
        $request->validate(['token' => 'required']);

        $tokenHP = $request->input('token'); 

        $result = $fcm->sendNotification(
            $tokenHP, 
            "Test Laravel", 
            "Cek Notifikasi Masuk"
        );

        if($result) {
            return response()->json(['status' => 'success', 'data' => $result]);
        }
        
        return response()->json(['status' => 'failed'], 500);
    }
}