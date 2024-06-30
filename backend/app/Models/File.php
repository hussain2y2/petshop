<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="File",
 *     type="object",
 *     title="File",
 *     description="File model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="uuid", type="string", example="95a22f4d-a9cd-3d97-bb95-37655f0f13f5"),
 *     @OA\Property(property="name", type="string", example="File Name"),
 *     @OA\Property(property="path", type="string", example="files/example.jpg"),
 *     @OA\Property(property="size", type="string", example="100K"),
 *     @OA\Property(property="type", type="string", example="image/jpeg"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'path',
        'size',
        'type',
    ];
}
