<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id', // Must match an existing company ID
            'email' => 'nullable|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
        ];
    }

      public function messages(): array
    {
        return [
            'company_id.required' => 'You must select a company for this employee.',
            'company_id.exists' => 'The selected company is invalid.',
        ];
    }
}
