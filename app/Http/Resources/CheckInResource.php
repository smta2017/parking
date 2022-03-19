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
            'plate_img' => $this->plate_img,
            'mobile' => $this->mobile,
            'driver_name' => $this->driver_name,
            'qr_code' => $this->id,
            'checkin' => $this->created_at->format('Y-m-d H:i'),
            'created_by' => new UserMiniResource($this->User),
        ];
    }
}
