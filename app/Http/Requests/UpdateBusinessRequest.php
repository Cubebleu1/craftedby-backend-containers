<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest
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
            'user_id' => 'sometimes|uuid',
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'postal_code' => 'sometimes|string|max:10',
            'city' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'siret' => 'sometimes|numeric|digits:14',
            'craft_id' => 'sometimes|uuid',
            'website' => 'sometimes|nullable|url|max:255',
            'biography' => 'sometimes|nullable|string',
            'history' => 'sometimes|nullable|string',
            'theme_id' => 'sometimes|uuid',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.uuid' => 'The user ID must be a valid UUID.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'postal_code.string' => 'The postal code must be a string.',
            'postal_code.max' => 'The postal code may not be greater than 10 characters.',
            'city.string' => 'The city must be a string.',
            'city.max' => 'The city may not be greater than 255 characters.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'phone_number.string' => 'The phone number must be a string.',
            'phone_number.max' => 'The phone number may not be greater than 20 characters.',
            'iret.numeric' => 'The siret must be a numeric value.',
            'iret.digits' => 'The siret must be 14 digits.',
            'craft_id.uuid' => 'The craft ID must be a valid UUID.',
            'website.url' => 'The website must be a valid URL.',
            'website.max' => 'The website may not be greater than 255 characters.',
            'biography.string' => 'The biography must be a string.',
            'history.string' => 'The history must be a string.',
            'theme_id.uuid' => 'The theme ID must be a valid UUID.',
        ];
    }

}
