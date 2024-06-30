<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *     @OA\Property(property="password", type="string", example="password"),
 *     @OA\Property(property="is_admin", type="boolean", example=false),
 *     @OA\Property(property="avatar", type="string", example="files/profile.png"),
 *     @OA\Property(property="address", type="string", example="Kamal Town 12676, NY, USA"),
 *     @OA\Property(property="phone_number", type="string", example="+4915731790256"),
 *     @OA\Property(property="is_marketing", type="boolean", example=false),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time"),
 *     @OA\Property(property="last_login_at", type="string", format="date-time"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time")
 * )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'email',
        'password',
        'is_admin',
        'avatar',
        'address',
        'phone_number',
        'is_marketing',
        'last_login_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_marketing' => 'boolean',
            'last_login_at' => 'datetime'
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
