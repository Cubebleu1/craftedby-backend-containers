<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'business_id' => 'sometimes|uuid',
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'material_id' => 'sometimes|uuid',
            'size' => 'sometimes|string|max:100',
            'color_id' => 'sometimes|uuid',
            'customisable' => 'sometimes|boolean',
            'image_path' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'business_id.uuid' => 'The business ID must be a valid UUID.',
            'name.string' => 'The name must be a string of characters.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'price.numeric' => 'The price must be a number.',
            'stock.integer' => 'The stock must be an integer.',
            'material_id.uuid' => 'The material ID must be a valid UUID.',
            'size.string' => 'The size must be a string of characters.',
            'size.max' => 'The size may not be greater than 100 characters.',
            'color_id.uuid' => 'The color ID must be a valid UUID.',
            'customisable.boolean' => 'The customisable field must be a boolean.',
            'image_path.string' => 'The image path must be a string of characters.',
            'image_path.max' => 'The image path may not be greater than 255 characters.',
        ];
    }
}
