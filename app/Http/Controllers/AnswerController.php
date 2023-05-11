<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\Answer\AnswerResource;
use App\Services\Answers\DeleteAnswer;
use App\Services\Answers\IndexAnswer;
use App\Services\Answers\ShowAnswer;
use App\Services\Answers\StoreAnswer;
use App\Services\Answers\UpdateAnswer;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    use JsonRespondController;

    public function index(Request $request)
    {
        try {
            $answer = app(IndexAnswer::class)->execute($request->all());
            return new AnswerCollection($answer);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function store(Request $request)
    {
        try {
            app(StoreAnswer::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function show(string $id)
    {
        try {
            $answer = app(ShowAnswer::class)->execute([
                'id' => $id,
            ]);
            return new AnswerResource($answer);
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
            $answer = app(UpdateAnswer::class)->execute([
                'id' => $id,
                'answer' => $request->answer,
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

    public function destroy(string $id)
    {
        try {
            app(DeleteAnswer::class)->execute([
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
