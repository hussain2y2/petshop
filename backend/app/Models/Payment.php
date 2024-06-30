<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property string $uuid
 * @property string $type
 * @property array $details
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
