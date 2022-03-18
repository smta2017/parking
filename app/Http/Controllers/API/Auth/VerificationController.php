<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Traits\SMSTrait;
use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use SMSTrait;

    
    public function sendMobileOTP($phone_number)
    {
        $res =  $this->sendOTP($phone_number);
        return  ApiResponse::format("success", $res);
    }

    
    public function confirmOTP($phone_number, $otp)
    {
        $res =  $this->verifyOTP($phone_number, $otp);
        if ($res->valid == true) {
            return  ApiResponse::format("success", $res);
        } else {
            return  ApiResponse::format("fail", $res, false);
        }
    }

    public function verifyEmail($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(253);
        }
        $user = User::findOrfail($user_id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return  ApiResponse::format("success", $user);
    }
}
