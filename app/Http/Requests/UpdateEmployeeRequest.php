<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request of editing the employee's detials.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       // Fetches the 'employee' parameter from your route URL: /employees/{employee}/edit
        $employeeId = $this->route('employee');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => [
                'nullable',
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
            'phone' => 'nullable|string|max:20',
        ];
    }
        // Error messages for the above rules failing validation
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'company_id.required' => ''You must select a valid company for this employee.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already assigned to another employee.',
        ];
    }
}
