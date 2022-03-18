<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    
    protected $auth;

    
    public function __construct(AuthRepository $auth)
    {
        return $this->auth = $auth;
    }

   

    public function forgotPassword(Request $request)
    {
        $data = $this->auth->forgotPassword($request);
        return $data;
        return  ApiResponse::format( "success", $data,'Email sent.');
    }


    public function resetView(Request $request)
    {
        return $this->auth->resetView($request);
    }

    public function resetPassword(Request $request)
    {
        return $this->auth->resetPassword($request);
    }
}
