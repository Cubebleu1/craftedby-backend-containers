<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            $this->mergeWhen($request->has('user') && $request->input('user') == true, [
                'last_name' => $this->last_name,
                'first_name' => $this->first_name,
                'address' => $this->address,
                'postal_code' => $this->postal_code,
                'city' => $this->city,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ]),
        ];
    }
}
