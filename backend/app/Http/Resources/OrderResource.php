<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OrderResource
 *
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'products' => $this->products,
            'address' => $this->address,
            'delivery_fee' => $this->delivery_fee,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'shipped_at' => $this->shipped_at,
            'order_status' => new OrderStatusResource($this->orderStatus),
            'payment' => new PaymentResource($this->payment),
        ];
    }
}
