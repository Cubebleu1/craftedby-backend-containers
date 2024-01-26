<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'website' => $this->website,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            $this->mergeWhen($request->business, [
                'address' => $this->address,
                'postal_code' => $this->postal_code,
                'city' => $this->city,
                'siret' => $this->siret,
                'craft_id' => $this->craft_id,
                'biography' => $this->biography,
                'history' => $this->history,
                'theme_id' => $this->theme_id,
                'user_id' => $this->user_id,
            ])
        ];
    }
}
