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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       // Fetches the 'company' parameter from your route URL: /companies/{company}/edit
        $companyId = $this->route('company'); 

        return [
            'name' => 'required|string|max:255',
            // Tells the database validation to ignore this specific record ID
            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($companyId),
            ],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url',
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'A company name is required.',
            'email.unique' => 'This email address is already registered to another company.',
            'logo.dimensions' => 'The logo must be at least 100x100 pixels in size.',
        ];
    }
}
