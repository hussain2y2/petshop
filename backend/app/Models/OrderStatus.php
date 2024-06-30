<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * /**
 * @OA\Schema(
 *     schema="OrderStatus",
 *     type="object",
 *     title="OrderStatus",
 *     description="OrderStatus model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="uuir", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="title", type="string", example="Pending"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
