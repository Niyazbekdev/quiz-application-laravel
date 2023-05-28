<?php

namespace App\Http\Controllers;

use App\Services\Resutl\StoreResult;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResultController extends Controller
{
    use JsonRespondController;
    public function index()
    {
        //
    }

    public function store(Request $request, string $collection_id, string $question_id)
    {
        try {
                app(StoreResult::class)->execute([
                    'collection_id' => $collection_id,
                    'question_id' => $question_id,
                    'answer_id' => $request->answer_id,
                ]);
                return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
