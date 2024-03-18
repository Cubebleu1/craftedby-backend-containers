<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change to 'true' if you want to authorize all users, or implement your authorization logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
//            'order_number' => 'required|numeric',
            'user_id' => 'required|uuid',
            'total_without_tax' => 'required|numeric|min:0',
            'tax_amount' => 'required|numeric|min:0',
            'total_tax_included' => 'required|numeric|min:0',
            'payment_status' => 'required|boolean',
        ];
    }
}
