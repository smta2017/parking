<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckOutClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $diff_time = $this->created_at->diffInMinutes($this->out_at, false);
        $diff_time2 = $this->created_at->diff($this->out_at);

        $subs = app('rinvex.subscriptions.plan_subscription')->ofSubscriber($this->Client)->orderBy('ends_at', 'desc')->first();
        $subscripe = $this->Client->subscription($subs['slug']);

        // $plan = app('rinvex.subscriptions.plan')->find($subs['plan_id']);
      

        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'plate_img' => url('') . '/storage/images/plate/' . $this->plate_img,
            'mobile' => $this->mobile,
            'driver_name' => $this->driver_name,
            'zone' => $this->Zone['name'],
            'qr_code' => $this->Client->id,
            'checkin' => $this->created_at->format('Y-m-d H:i'),
            'checkin_hu' => $this->created_at->diffForHumans(),
            'checkout' => $this->out_at,
            'total_time' => [
                'days' => $diff_time2->days,
                'hours' => $diff_time2->h . ':' . $diff_time2->i . ':' . $diff_time2->s,
            ],
            // 'subscribe_ended_at' => $subscripe['ends_at']->format('Y-m-d'),
            // 'plan_name' => $plan['name'],
            // 'subscribe_price' => $plan['price'],
            'subscribe_ended' => $subscripe->ended(),
            'created_by' => new UserMiniResource($this->User),
        ];
    }
}
