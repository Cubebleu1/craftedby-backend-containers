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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            $this->mergeWhen($request->user, [
                'address' => $this->address,
                'postal_code' => $this->postal_code,
                'city' => $this->city,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ]),
                $this->mergeWhen($request->single_user, [
                'reviews' => ReviewResource::collection($this->reviews),
                ]),
        ];
    }
}
