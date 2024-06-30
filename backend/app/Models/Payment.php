<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Payment",
 *     type="object",
 *     title="Payment",
 *     description="Payment model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="type", type="number", format="float", example=99.99),
 *     @OA\Property(
 *          property="details",
 *          type="object",
 *          @OA\Property(property="holder_name", type="string", example="Testing"),
 *          @OA\Property(property="number", type="number", example="7976767676766776"),
 *          @OA\Property(property="ccv", type="number", example="787"),
 *          @OA\Property(property="expire_date", type="number", example="09 25")
 *      ),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',
        'details'
    ];

    // Accessor for the details field
    public function getDetailsAttribute($value): object
    {
        return (object) json_decode($value, true);
    }

    // Mutator for the details field
    public function setDetailsAttribute($value): void
    {
        $this->attributes['details'] = json_encode($value);
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
