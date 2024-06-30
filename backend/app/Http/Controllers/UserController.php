<?php

namespace App\Http\Controllers;

/**
 * @OA\PathItem(path="/api/v1/user")
 */
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Users"},
     *     summary="Get Auth Usser",
     *     description="Returns a single user",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * @OA\Put(
     *     path="/edit",
     *     tags={"Users"},
     *     summary="Update an existing user",
     *     description="Updates an existing user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function update(UserRequest $request): UserResource
    {
        $user = auth()->user();
        $request['password'] = bcrypt($request->password);
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * @OA\Delete(
     *     path="/",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     description="Deletes a user",
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     )
     * )
     */
    public function destroy($uuid): JsonResponse
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
