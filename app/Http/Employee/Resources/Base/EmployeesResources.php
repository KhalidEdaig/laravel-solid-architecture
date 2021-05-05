<?php

namespace App\Http\Employee\Resources\Base;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResources extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'company_id' => $this->company_id,
            'company' => $this->whenLoaded('company'),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
