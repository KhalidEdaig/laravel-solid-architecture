<?php

namespace App\Http\Company\Resources\Base;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompaniesResourcesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
