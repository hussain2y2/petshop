<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    // Accessor for the products field
    public function getProductsAttribute($value): object
    {
        return json_decode($value, true);
    }

    // Mutator for the products field
    public function setProductsAttribute($value): void
    {
        $this->attributes['products'] = json_encode($value);
    }

    // Accessor for the address field
    public function getAddressAttribute($value): object
    {
        return json_decode($value, true);
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
