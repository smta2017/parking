<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckOutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $diff_time =  $this->created_at->diffInMinutes($this->out_at,false);
        $diff_time2 =  $this->created_at->diff($this->out_at);
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'plate_img' => $this->plate_img,
            'mobile' => $this->mobile,
            'driver_name' => $this->driver_name,
            'zone_id' => $this->zone_id,
            'qr_code' => "$this->id",
            'checkin' => $this->created_at->format('Y-m-d H:i'),
            'checkin_hu' => $this->created_at->diffForHumans(),
            'checkout' => $this->out_at,
            'total_time' => [
                'days' => $diff_time2->days,
                'hours' => $diff_time2->h . ':' . $diff_time2->i,
            ],
            'hour_rate'=>5,
            'amount' => ($diff_time/60)*5,
            'created_by' => new UserMiniResource($this->User),
        ];
    }
}
