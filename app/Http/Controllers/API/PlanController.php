<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\CustomerVehicle;
use Illuminate\Http\Request;

class PlanController extends AppBaseController
{

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/subscriptions",
     *      summary="Create a newly subscription for a vehicle",
     *      tags={"Mobile-Api"},
     *      description="New Subscription",
     *      produces={"application/json"},
     *      security = {{"Bearer": {}}},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="vehicle that should be stored",
     *          required=false,
     *          @SWG\Schema(example= {
     *                                "customer_id":15,
     *                                "plan_id":1
     *                              }
     *          )
     *      ),
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
     *                  ref="#"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function createSubscription(Request $request)
    {
        $vehicle_id = $request["customer_id"];

        $plan = app('rinvex.subscriptions.plan')->find($request["plan_id"]);

        $vehicle = CustomerVehicle::findOrFail($vehicle_id);

        $new_subscription = $vehicle->newSubscription($vehicle["plate_number"] . "-" . $vehicle['name'] . '-' . $plan['name'], $plan);

        return $this->sendResponse($new_subscription, 'Subscription created as successfully');
    }
}
