<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'business_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'material_id' => 'required|uuid',
            'size' => 'required|string|max:100',
            'color_id' => 'required|uuid',
            'customisable' => 'required|boolean',
            'image_path' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'business_id.required' => 'The business ID field is required.',
            'business_id.uuid' => 'The business ID must be a valid UUID.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string of characters.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be an integer.',
            'material_id.required' => 'The material ID field is required.',
            'material_id.uuid' => 'The material ID must be a valid UUID.',
            'size.required' => 'The size field is required.',
            'size.string' => 'The size must be a string of characters.',
            'size.max' => 'The size may not be greater than 100 characters.',
            'color_id.required' => 'The color ID field is required.',
            'color_id.uuid' => 'The color ID must be a valid UUID.',
            'customisable.required' => 'The customisable field is required.',
            'customisable.boolean' => 'The customisable field must be a boolean.',
            'image_path.string' => 'The image path must be a string of characters.',
            'image_path.max' => 'The image path may not be greater than 255 characters.',
        ];
    }

}
