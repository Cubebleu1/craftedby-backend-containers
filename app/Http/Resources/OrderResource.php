<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'order';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            $this->mergeWhen($request->order, [
                'total_without_tax' => $this->total_without_tax,
                'tax_amount' => $this->tax_amount,
                'total_tax_included' => $this->total_tax_included,
                'payment_status' => $this->payment_status,

                'user' => new UserResource($this->user),
            ])
        ];
    }
}
