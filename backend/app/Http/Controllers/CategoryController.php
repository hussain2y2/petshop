<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

/**
 * @OA\PathItem(path="/api/v1")
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     description="Returns a list of categories",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    /**
     * @OA\Post(
     *     path="/catefgory/create",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     description="Creates a new category",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
    public function create(CategoryRequest $request): CategoryResource
    {
        $category = Category::create([
            'uuid' => Str::uuid()->toString(),
            'slug' => Str::slug($request->title),
            'title' => $request->title,
        ]);

        return new CategoryResource($category);
    }

    /**
     * @OA\Put(
     *     path="/category/{uuid}",
     *     tags={"Categories"},
     *     summary="Update an existing category",
     *     description="Updates an existing category",
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
    public function update(CategoryRequest $request, string $uuid): CategoryResource
    {
        $category = Category::where('uuid', $uuid)->first();
        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title)
        ]);

        return new CategoryResource($category);
    }

    /**
     * @OA\Get(
     *     path="/category/{uuid}",
     *     tags={"Categories"},
     *     summary="Get category by UUID",
     *     description="Returns a single category",
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     )
     * )
     */
    public function show(string $uuid): CategoryResource
    {
        $category = Category::where('uuid', $uuid)->first();

        return new CategoryResource($category);
    }

    /**
     * @OA\Delete(
     *     path="/category/{uuid}",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     description="Deletes a category",
     *     @OA\Parameter(
     *         name="uuid",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     )
     * )
     */
    public function delete(string $uuid): Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            Category::where('uuid', $uuid)->delete();

            return response([
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
