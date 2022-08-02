<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerVehicleResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'plate_number' => $this->plate_number,
            'vehicle_color' => $this->vehicle_color,
            'vehicle_brand' => $this->vehicle_brand,
            'vehicle_model' => $this->vehicle_model,
            'vehicle_model_year' => $this->vehicle_model_year,
            'vehicle_type' => $this->vehicle_type,
            'slot' => $this->slot,
            'license_number' => $this->license_number,
            'license_expiration' => $this->license_expiration,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
