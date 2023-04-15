<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class Property extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'string|required|min:1|max:128',
			'real_estate_type' => 'string|required|in:House,Department,Land,Commercial_Ground',
			'street' => 'string|required|min:1|max:128',
			'external_number' => 'alpha_dash|required|min:1|max:12',
			'internal_number' => 'alpha_dash|required_unless:real_estate_type,House,Land|max:12',
			'neighborhood' => 'string|required|min:1|max:128',
			'city' => 'string|required|min:1|max:64',
			'country' => 'alpha:ascii|required|size:2|exists:countries,country_code',
			'rooms' => 'numeric|required',
			'bathrooms' => 'numeric|required',
			'comments' => 'string|nullable|max:128'
        ];
    }

	public function withValidator($validator) {
		$validator->after(function($validator) {
			if (in_array($this->input('real_estate_type'), ['House', 'Department']) && !$this->input('bathrooms') > 0)
				$validator->errors()->add('bathrooms', 'Must have atleast one bathroom for House & Department');
		});
	}
}
