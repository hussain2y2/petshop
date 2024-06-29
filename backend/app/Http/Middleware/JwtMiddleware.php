<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        try {
            $decoded = JwtHelper::validateToken($token);
            $user = User::where('uuid', $decoded->sub)->first();

            if (!$user) {
                return response()->json(['message' => 'User not found'], 401);
            }

            $request->attributes->set('user', $user);
            auth()->login($user);
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
