<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\CustomerVehicle;
use Illuminate\Http\Request;

class PlanController extends AppBaseController
{

    
    public function createSubscription(Request $request)
    {
        return $request;
        $vehicle_id = $request["customer_id"];

        $plan = app('rinvex.subscriptions.plan')->find($request["plan_id"]);

        $vehicle = CustomerVehicle::findOrFail($vehicle_id);

        $new_subscription = $vehicle->newSubscription($vehicle["plate_number"] . "-" . $vehicle['name'] . '-' . $plan['name'], $plan);

        return $this->sendResponse($new_subscription, 'Subscription created as successfully');
    }
}
