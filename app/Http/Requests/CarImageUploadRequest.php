<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CarImageUploadRequest extends FormRequest
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
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
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
            'image.required' => 'Image is required!',
            'image.mimes'    => 'Image type is invalid!',
            'weight.max'     => 'Image size is invalid!'
        ];
    }
}
