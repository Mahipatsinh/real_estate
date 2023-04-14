<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyListResource extends JsonResource
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
			'City' => $this->city,
			'Country' => $this->country,
		];
    }
}
