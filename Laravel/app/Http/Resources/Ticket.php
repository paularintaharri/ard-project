<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\User as UserResource;

class Ticket extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'street_address' => $this->street_address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'country' => $this->country,
            'user' => $this->user,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
        ];
    }
}
