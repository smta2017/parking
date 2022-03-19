<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   schemes={"http","https"},
 * 
 * @swg\SecurityScheme(
 *      securityDefinition="Bearer",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *      description="Auth Bearer Token
 *      Format as 'Bearer <access_token>'",
 *  ),
 * 
 *  @SWG\Tag(
 *     name="User",
 *     description="System users Auth"
 *   ),
 *   @SWG\Tag(
 *     name="Auth",
 *     description="System users Auth"
 *   ),
 *   @SWG\Tag(
 *     name="Mobile-Api",
 *     description="System users Auth"
 *   ),
 *  
 *   @SWG\Info(
 *     title="Specialist APP APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
