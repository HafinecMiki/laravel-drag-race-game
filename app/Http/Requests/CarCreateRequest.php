<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CarCreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand'           => 'required|string',
            'type'            => 'required|string',
            'weight'          => 'required|numeric|between:0,9999',
            'performance'     => 'required|numeric|between:0,9999',
            'production_date' => 'required|date',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'brand.required'           => 'Brand is required!',
            'type.required'            => 'Type is required!',
            'weight.required'          => 'Weight is required!',
            'performance.required'     => 'Performance is required!',
            'production_date.required' => 'Production date is required!',
            'weight.between'           => 'Invalid value! Weight is between 0 - 9999!',
            'performance.between'      => 'Invalid value! Performance is between 0 - 9999!'
        ];
    }
}
