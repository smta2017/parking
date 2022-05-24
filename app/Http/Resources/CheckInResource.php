<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckInResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'plate_img' => url('') . '/storage/images/plate/' . $this->plate_img,
            'zone' => $this->Zone['name'],
            'hour_rate' => $this->Zone['hour_rate'],
            'mobile' => $this->mobile,
            'driver_name' => $this->driver_name,
            'qr_code' => "$this->id",
            'checkin' => $this->created_at->format('Y-m-d H:i'),
            'created_by' => new UserMiniResource($this->User),
        ];
    }
}
