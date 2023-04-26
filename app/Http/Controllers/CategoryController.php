<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\Category\DeleteCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $category = app(IndexCategory::class)->execute([]);
        return  CategoryResource::collection($category);
    }
    public function store(Request $request)
    {
        try {
            $category = app(StoreCategory::class)->execute($request->all());
            return new CategoryResource($category);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
    public function show(string $id)
    {
        try {
            $category = app(ShowCategory::class)->execute([
                'id'=>$id,
            ]);
            return new CategoryResource($category);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $category = app(UpdateCategory::class)->execute([
                'id' => $id,
                'name' => $request->name,
            ]);
            return response([
                'successful' => true,
            ]);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
    public function destroy(string $id)
    {
        try {
            $category = app(DeleteCategory::class)->execute([
                'id' => $id,
            ]);
            return response([
                'successful' => true,
            ]);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
}
