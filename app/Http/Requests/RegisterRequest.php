<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'phone' => 'required|string|max:15|unique:profiles,phone',
            'residential_address' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'student_identity_number' => 'nullable|string|max:50',
            'country_of_origin' => 'required|string|max:100',
            'university_name' => 'required|string|max:255',
            'affiliate' => 'required|string|max:255',
            'university_address' => 'required|string|max:255',
            'university_country' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
