<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class StoreAnswer extends BaseServices
{
    public function rules(): array
    {
        return [
            'question_id'=> 'required',
            'answer' => 'required',
            'is_correct' => 'boolean',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       Answer::create([
           'question_id' => $data['question_id'],
           'answer' => $data['answer'],
           'is_correct' => $data['is_correct'],
       ]);
       return true;
   }
}
