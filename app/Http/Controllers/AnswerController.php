<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\Answer\AnswerResource;
use App\Services\Answers\DeleteAnswer;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    use JsonRespondController;
    public function destroy(string $id): JsonResponse
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
