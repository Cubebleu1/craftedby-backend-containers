<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'remember-token' => 'string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string of characters.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string of characters.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a string of characters.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'postal_code.required' => 'The postal code field is required.',
            'postal_code.string' => 'The postal code must be a string of characters.',
            'postal_code.max' => 'The postal code may not be greater than 255 characters.',
            'city.required' => 'The city field is required.',
            'city.string' => 'The city must be a string of characters.',
            'city.max' => 'The city may not be greater than 255 characters.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'The phone number must be a string of characters.',
            'phone_number.max' => 'The phone number may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'remember-token.string' => 'The remember token must be a string of characters.',
            'remember-token.max' => 'The remember token may not be greater than 255 characters.',
        ];
    }

}
