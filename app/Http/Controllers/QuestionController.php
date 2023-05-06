<?php

namespace App\Http\Controllers;

use App\Http\Resources\Question\QuestionResource;
use App\Http\Resources\Question\QuestionWithAnswers;
use App\Services\Question\DeleteQuestion;
use App\Services\Question\IndexQuestion;
use App\Services\Question\ShowQuestion;
use App\Services\Question\StoreQuestion;
use App\Services\Question\UpdateQuestion;
use Exception;
use App\Traits\JsonRespondController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    use JsonRespondController;

    public function index(Request $request)
    {
        try {
            return app(IndexQuestion::class)->execute($request->all());
        }catch (ValidationException $exception){
             return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function store(Request $request){
        try {
            app(StoreQuestion::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            [$question, $answers] =  app(ShowQuestion::class)->execute([
                'id' => $id,
            ]);
            return (new QuestionWithAnswers($question))->setAnswers($answers);
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
            app(UpdateQuestion::class)->execute([
                'id' => $id,
                'question' => $request->question,
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

    public function destroy(Request $request, string $id)
    {
        try {
            app(DeleteQuestion::class)->execute([
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
