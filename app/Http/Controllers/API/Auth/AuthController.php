<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;
use Auth;

class AuthController extends AppBaseController
{


    protected $auth;


    public function __construct(AuthRepository $auth)
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
        return $this->auth = $auth;
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/auth/login",
     *      summary="User Login",
     *      tags={"Auth"},
     *      description="the system users login",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * 
     *  @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CustomerAddress that should be updated",
     *          required=false,
     *          @SWG\Schema(example= {
     *                                "email":"admin@admin.com",
     *                                "password":"password"
     *                              }
     *          )
     *      ),
     * 
     * )
     */

    public function login()
    {
        $credentials = request(['email', 'password']);
        return $this->auth->loginUser($credentials);
    }




    /**
     *
     * @param  \Illuminate\Http\Request  $request
     *  * @SWG\Post(
     *      path="/auth/register",
     *      summary="User registration",
     *      tags={"Auth"},
     *      consumes={"multipart/form-data, boundary=----WebKitFormBoundaryyrV7KO0BoCBuDbTL"},
     *      produces={"application/json"},
     *      description="the system users login",
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * 
     *      @SWG\Parameter(
     *          name="image",
     *          description="user photo",
     *          type="file",
     *          required=false,
     *          in="formData"
     *      ),
     *      @SWG\Parameter(
     *             name="name",
     *             description="name",
     *             default="sameh",           
     *             type="string",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="email",
     *             description="email",
     *             default="email@example.com",           
     *             type="string",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="phone",
     *             description="phone",
     *             default="+20125655445",           
     *             type="string",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="password",
     *             description="password",
     *             default="password",           
     *             type="string",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="zone_id",
     *             description="zone_id",
     *             default="1",           
     *             type="integer",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="job_title",
     *             description="job_title",
     *             default="job_title",           
     *             type="string",
     *             required=false,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="dob",
     *             description="Date Of Birth",
     *             default="2020/10/10",           
     *             type="string",
     *             format ="date",
     *             required=false,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="edu",
     *             description="edu",
     *             default="education",           
     *             type="string",
     *             required=false,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="firebase_token",
     *             description="firebase_token",
     *             default="firebase_token",           
     *             type="string",
     *             required=false,
     *             in="query"
     *      ),
     * )
     */
    public function register(RegisterRequest $request)
    {
    
        $user = $this->auth->registerUser($request);
        return  $this->sendResponse($user, "success");
    }




    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  * @SWG\Post(
     *      path="/auth/me",
     *      summary="User registration",
     *      tags={"Auth"},
     *      description="get user info",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     * )
     */

    public function me()
    {
        return ApiResponse::format("sucsess", new UserResource(auth()->user()));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->auth->logout(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->user()->createToken('')->plainTextToken);
    }

    public function forgotPassword(Request $request)
    {
        return $this->auth->forgotPassword($request);
    }
}
