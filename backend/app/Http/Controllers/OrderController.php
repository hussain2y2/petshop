<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\PathItem(path="/api/v1/user")
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/orders",
     *     tags={"Orders"},
     *     summary="Get list of orders",
     *     description="Returns a list of orders",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Order"))
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $user = auth()->user();

        return OrderResource::collection(Order::whereUserId($user->id)->get());
    }
}
