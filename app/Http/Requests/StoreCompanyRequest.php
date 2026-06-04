<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:companies,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:2048',
            'website' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A company name is required.',
            'name.max' => 'The company name cannot exceed 255 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered to another company.',
            'logo.image' => 'The uploaded file must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, or svg.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels in size.',
            'logo.max' => 'The logo file size must not be larger than 2 Megabytes.',
            'website.url' => 'The website address format is invalid. Make sure it includes http:// or https://.',
        ];
    }
}
