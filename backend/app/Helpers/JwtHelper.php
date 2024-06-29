<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    public static function generateToken($user): string
    {
        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->uuid,
            'iat' => time(),
            'exp' => time() + 60*60*24 // 1 day expiration
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public static function validateToken($token): \stdClass
    {
        return JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
    }
}
