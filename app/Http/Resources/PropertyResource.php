<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
		return [
			'PropertyId' => $this->id,
			'PropertyName' => $this->name,
			'PropertyType' => $this->real_estate_type,
			'Street' => $this->street,
			'ExternalNumber' => $this->external_number,
			'InternalNumber' => $this->internal_number,
			'Neighborhood' => $this->neighborhood,
			'City' => $this->city,
			'Country' => $this->country,
			'Rooms' => $this->rooms,
			'Bathrooms' => $this->bathrooms,
			'Comments' => $this->comments
		];
    }
}
