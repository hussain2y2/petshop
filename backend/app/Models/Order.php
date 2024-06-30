<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * Class Order
 *
 *
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Order",
 *     description="Order model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="order_status_id", type="integer", example=1),
 *     @OA\Property(property="payment_id", type="integer", example=1),
 *     @OA\Property(property="uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(
 *          property="products",
 *          type="object",
 *          @OA\Property(property="product", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *          @OA\Property(property="price", type="string", example="9.99")
 *      ),
 *     @OA\Property(
 *           property="address",
 *           type="object",
 *           @OA\Property(property="billing", type="string", example="Billing Address"),
 *           @OA\Property(property="shipping", type="string", example="Shipping Address")
 *       ),
 *     @OA\Property(property="deliver_fee", type="number", format="float", example=99.99),
 *     @OA\Property(property="amount", type="number", format="float", example=99.99),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="shipped_at", type="string", format="date-time")
 * )
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_status_id',
        'payment_id',
        'uuid',
        'products',
        'address',
        'delivery_fee',
        'amount',
        'shipped_at'
    ];

    protected $casts = [
        'products' => 'object',
        'address' => 'object',
        'shipped_at' => 'datetime'
    ];

    // Accessor for the products field
    public function getProductsAttribute($value): object
    {
        return (object) json_decode($value, true);
    }

    // Mutator for the products field
    public function setProductsAttribute($value): void
    {
        $this->attributes['products'] = json_encode($value);
    }

    // Accessor for the address field
    public function getAddressAttribute($value): object
    {
        return (object) json_decode($value, true);
    }

    // Mutator for the address field
    public function setAddressAttribute($value): void
    {
        $this->attributes['address'] = json_encode($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
