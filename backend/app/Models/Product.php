<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="category_uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="title", type="string", example="Product Name"),
 *     @OA\Property(property="description", type="string", example="Product Description"),
 *     @OA\Property(property="price", type="number", format="float", example=49.99),
 *     @OA\Property(
 *           property="products",
 *           type="object",
 *           @OA\Property(property="brand", type="string", example="Brand Name"),
 *           @OA\Property(property="image", type="string", example="Image")
 *       ),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'category_uuid',
        'title',
        'price',
        'description',
        'metadata'
    ];

    // Accessor for the metadata field
    public function getMetadataAttribute($value): object
    {
        return json_decode($value, true);
    }

    // Mutator for the metadata field
    public function setMetadataAttribute($value): void
    {
        $this->attributes['metadata'] = json_encode($value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }
}
