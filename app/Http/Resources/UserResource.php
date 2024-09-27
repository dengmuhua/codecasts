<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return  [
                'id' => $this->id,
                'phone' => $this->when(true, $this->phone),
            ] + parent::toArray($request);
    }
}
