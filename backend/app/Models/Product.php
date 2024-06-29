<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return $this->belongsTo(Category::class);
    }
}
