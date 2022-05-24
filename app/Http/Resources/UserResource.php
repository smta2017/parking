<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'phone' => $this->phone,
            'national_id' => $this->national_id,
            'dop' => $this->dop,
            'avatar' => url('') . '/storage/images/avatar/' . $this->avatar,
            'phone_verified_at' => $this->phone_verified_at,
            'gender' => $this->gender,
            'sms_notification' => $this->sms_notification,
            'is_active' => $this->is_active,
            'lang' => $this->lang,
            'firebase_token' => $this->firebase_token,
            'google_id' => $this->google_id,
            'facebook_id' => $this->facebook_id,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString()
        ];
    }
}
