<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\Category\DeleteCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    use JsonRespondController;
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
    public function show( string $id)
    {
        try {
            $category = app(ShowCategory::class)->execute([
                'id'=>$id,
            ]);
            return new CategoryResource($category);
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $category = app(UpdateCategory::class)->execute([
                'id' => $id,
                'name' => $request->name,
            ]);
            return $this->respondSuccess();
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
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
}
