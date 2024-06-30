<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * @param UserRequest $request
     * @return UserResource
     */
    public function update(UserRequest $request): UserResource
    {
        $user = auth()->user();
        $request['password'] = bcrypt($request->password);
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy($uuid): JsonResponse
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
