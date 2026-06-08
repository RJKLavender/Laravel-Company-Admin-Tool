<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request of editing the company's detials.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       // Fetches the 'company' parameter from your route URL: /companies/{company}/edit
        $companyId = $this->route('company'); 

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($companyId),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:2048',
            'website' => 'nullable|url',
        ];
    }
        // Error messages for the above rules failing validation
     public function messages(): array
    {
        return [
            'name.required' => 'A company name is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered to another company.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, or svg.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels in size.',
            'logo.max' => 'The logo file size must not be larger than 2 Megabytes.',
            'website.url' => 'The website address format is invalid. Make sure it includes http:// or https://.',
        ];
    }
}
