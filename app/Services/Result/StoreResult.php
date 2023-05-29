<?php

namespace App\Services\Result;

use App\Models\Answer;
use App\Models\Result;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StoreResult extends BaseServices
{
    public function rules(): array
    {
        return [
            'collection_id' => 'exists:collections,id',
            'question_id' => 'exists:questions,id',
            'answer_id' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       $answer = Answer::findOrFail($data['answer_id']);
       Result::create([
           'collection_id' => $data['collection_id'],
           'question_id' => $data['question_id'],
           'user_id' => Auth::id(),
           'answer_id' => $data['answer_id'],
           'is_correct' => $answer['is_correct'],
       ]);
       return true;
   }
}
