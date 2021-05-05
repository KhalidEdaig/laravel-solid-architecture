<?php

namespace App\Http\User\Resources\Base;

use Carbon\Carbon;
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
            'id'=>$this->id,
            'username' => $this->username,
            'email' => $this->email,
            'isAdmin'=>$this->hasRole('super_admin'),
            'roles'=>$this->getRoleNames(),
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y')
        ];
    }
}
