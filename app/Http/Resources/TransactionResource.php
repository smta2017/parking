<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'plate_number' => $this->plate_number,
            'plate_img' => $this->plate_img,
            'zone' => $this->Zone->name,
            'created_by' => $this->created_by,
            'out_at' => $this->out_at,
            'qr_code' => $this->qr_code,
            'is_bayed' => $this->is_bayed,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString()
        ];
    }
}
