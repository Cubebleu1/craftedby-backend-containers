<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessRequest extends FormRequest
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
            'user_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'siret' => 'required|numeric|digits:14',
            'craft_id' => 'required|uuid',
            'website' => 'nullable|url|max:255',
            'biography' => 'nullable|string',
            'history' => 'nullable|string',
            'theme_id' => 'required|uuid',
        ];
    }
    public function messages(): array
    {
        return [
            'user_id.required' => 'The user ID field is required.',
            'user_id.uuid' => 'The user ID must be a valid UUID.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string of characters.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'address.required' => 'The address field is required.',
            'address.string' => 'The address must be a string of characters.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'postal_code.required' => 'The postal code field is required.',
            'postal_code.string' => 'The postal code must be a string of characters.',
            'postal_code.max' => 'The postal code may not be greater than 10 characters.',
            'city.required' => 'The city field is required.',
            'city.string' => 'The city must be a string of characters.',
            'city.max' => 'The city may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.string' => 'The phone number must be a string of characters.',
            'phone_number.max' => 'The phone number may not be greater than 20 characters.',
            'siret.required' => 'The SIRET field is required.',
            'siret.numeric' => 'The SIRET must be a number.',
            'siret.digits' => 'The SIRET must be 14 digits.',
            'craft_id.required' => 'The craft ID field is required.',
            'craft_id.uuid' => 'The craft ID must be a valid UUID.',
            'website.url' => 'The website must be a valid URL.',
            'website.max' => 'The website may not be greater than 255 characters.',
            'biography.string' => 'The biography must be a string of characters.',
            'history.string' => 'The history must be a string of characters.',
            'theme_id.required' => 'The theme ID field is required.',
            'theme_id.uuid' => 'The theme ID must be a valid UUID.',
        ];
    }


}
