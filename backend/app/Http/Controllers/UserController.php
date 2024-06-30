<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }

    public function update(Request $request, $uuid): JsonResponse
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy($uuid): JsonResponse
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
