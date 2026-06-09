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
     * Get the validation rules that apply to the request of adding an employee to the database.
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
            'phone' => 'nullable|string|max:20|phone:GB,AUTO',
        ];
    }
        // Error messages for the above rules failing validation
      public function messages(): array
    {
        return [
            'company_id.required' => 'You must select a valid company for this employee.',
            'company_id.exists' => 'The selected company is invalid.',
            'first_name.required' => 'First Name is required.',
            'last_name.required' => 'Last Name is required.',
            'first_name.max' => 'First Name cannot exceed 255 characters.',
            'last_name.max' => 'Last Name cannot exceed 255 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already assigned to another employee.',
            'phone.phone' => 'Please Enter a Valid Phone Number'
        ];
    }
}
