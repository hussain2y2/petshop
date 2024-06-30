<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property string $user_id
 * @property string $order_status_id
 * @property string $payment_id
 * @property string $uuid
 * @property string $products
 * @property string $address
 * @property float $delivery_fee
 * @property float $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $shipped_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderStatus $orderStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment $payment
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
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
