<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyListResource;
use App\Http\Resources\PropertyResource;
use App\Models\RealEstateProperty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
	private $validationRules = [
		'name' => 'string|required|min:1|max:128',
		'real_estate_type' => 'string|required|in:House,Department,Land,Commercial_Ground',
		'street' => 'string|required|min:1|max:128',
		'external_number' => 'alpha_dash|required|min:1|max:12',
		'internal_number' => 'string|required_unless:real_estate_type,house,real_estate_type,land',
		'neighborhood' => 'string|required|min:1|max:128',
		'city' => 'string|required|min:1|max:64',
		'country' => 'alpha:ascii|required|size:2',
		'rooms' => 'numeric|required',
		'bathrooms' => 'numeric|required',
		'comments' => 'string|nullable|max:128'
	];

    public function index(Request $request) {
		$properties = RealEstateProperty::query()->paginate();
		return PropertyListResource::collection($properties);
	}

	public function add(Request $request) {
		$request->validate($this->validationRules);
		$property = $this->save(new RealEstateProperty(), $request->input());
		return new PropertyResource($property);
	}

	public function edit(Request $request) {
		$request->validate(array_merge($this->validationRules, ['id' => 'numeric|required|exists:real_estate_properties,id']));
		$property = $this->save($this->getPropertyById($request->input('id')), $request->input());
		return new PropertyResource($property);
	}

	public function view(Request $request, $id) {
		$property = $this->getPropertyById($id);

		if(!$property)
			return response()->json(['msg' => 'Not Found'], 404);

		return new PropertyResource($property);
	}

	private function getPropertyById($propertyId) {
		return RealEstateProperty::query()->find($propertyId);
	}

	private function save(RealEstateProperty $property, $data) {
		$property->name = $data['name'];
		$property->real_estate_type = $data['real_estate_type'];
		$property->street = $data['street'];
		$property->external_number = $data['external_number'];
		$property->internal_number = $data['internal_number	'];
		$property->neighborhood = $data['neighborhood'];
		$property->city = $data['city'];
		$property->country = $data['country'];
		$property->rooms = $data['rooms'];
		$property->bathrooms = $data['bathrooms'];
		$property->comments = $data['comments'];
		$property->save();

		return $property;
	}

	public function delete(Request $request) {
		$request->validate(['id' => 'numeric|required|exists:real_estate_properties,id']);
		$property =  $this->getPropertyById($request->input('id'));
		$property->delete();
		return response()->json(['msg' => 'Property deleted successfully']);
	}
}
