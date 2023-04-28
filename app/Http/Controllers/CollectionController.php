<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection\CollectionCollection;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Collection\CollectionWithQuestionResource;
use App\Services\Collection\DeleteCollection;
use App\Services\Collection\IndexCollection;
use App\Services\Collection\ShowCollection;
use App\Services\Collection\StoreCollection;
use App\Services\Collection\UpdateCollection;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectionController extends Controller
{
    use JsonRespondController;


    public function index(Request $request): JsonResponse|CollectionCollection
    {
        try {
            $collections = app(IndexCollection::class)->execute($request->all());
            return new CollectionCollection($collections);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(StoreCollection::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function show(string $id): CollectionWithQuestionResource|JsonResponse
    {
        try {
            [$collections, $questions] = app(ShowCollection::class)->execute([
                'id'=> $id
            ]);
            return (new CollectionWithQuestionResource($collections))->setQuestions($questions);
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $collections = app(UpdateCollection::class)->execute([
                'id'=> $id,
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            [$collection, $questions] = app(DeleteCollection::class)->execute([
                'id' => $id,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }catch (ModelNotFoundException){
            return $this->respondNotFound();
        }catch (Exception $exception){
            $this->setHTTPStatusCode($exception->getCode());
            return $this->respondWithError($exception->getMessage());
        }
    }
}
