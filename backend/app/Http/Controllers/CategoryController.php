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

class CategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    public function create(CategoryRequest $request): CategoryResource
    {
        $category = Category::create([
            'uuid' => Str::uuid()->toString(),
            'slug' => Str::slug($request->title),
            'title' => $request->title,
        ]);

        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, string $uuid): CategoryResource
    {
        $category = Category::where('uuid', $uuid)->first();
        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title)
        ]);

        return new CategoryResource($category);
    }

    public function show(string $uuid): CategoryResource
    {
        $category = Category::where('uuid', $uuid)->first();

        return new CategoryResource($category);
    }

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
