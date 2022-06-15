<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckInClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $subs = app('rinvex.subscriptions.plan_subscription')->ofSubscriber($this->Client)->orderBy('ends_at', 'desc')->first();
        $subscripe = $this->Client->subscription($subs['slug']);

        $plan = app('rinvex.subscriptions.plan')->find($subs['plan_id']);
        
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'plate_img' => url('') . '/storage/images/plate/' . $this->plate_img,
            'zone' => $this->Zone['name'],
            // 'hour_rate' => $this->Zone['hour_rate'],
            'mobile' => $this->Client->phone,
            // 'driver_name' => $this->driver_name,
            'qr_code' => $this->Client->id,
            'subscribe_ended_at' => $subscripe['ends_at']->format('Y-m-d'),
            'plan_name' => $plan['name'],
            'subscribe_price' => $plan['price'],
            'subscribe_ended' => $subscripe->ended(),
            'checkin' => $this->created_at->format('Y-m-d H:i'),
            'created_by' => new UserMiniResource($this->User),
        ];
    }
}
