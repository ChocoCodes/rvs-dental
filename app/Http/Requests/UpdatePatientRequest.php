<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
class UpdatePatientRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|max:255|string',
            'last_name' => 'sometimes|max:255|string',
            'address' => 'sometimes|string|max:255',
            'contact_no' => 'sometimes|regex:/^09\d{9}$/',
            'image_filename' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'date_of_birth' => 'sometimes|before:today|date',
            'occupation' => 'sometimes|string|max:255',
            'marital_status' => 'sometimes|in:Single,Married,Widowed,Separated',
            'guardian_name' => 'nullable|string|max:255',
            'sex' => 'sometimes|in:Male,Female',
        ];
    }

    public function messages(): array {
        return [
            'date_of_birth.before' => 'Date of birth must be in the past.',
            'sex.in' => 'Sex must be either Male or Female only.',
            'marital_status.in' => 'Invalid marital status.',
            'image_filename.mimes' => 'Image must be of the following formats only: .JPEG, .JPG, .PNG.',
            'contact_no.regex' => 'Contact number must be a valid Philippine mobile number (e.g., 09123456789).'
        ];
    }
}
