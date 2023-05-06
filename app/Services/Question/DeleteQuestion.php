<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:questions,id',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       $questions = Question::find($data['id']);
       $answers = Answer::where('question_id', $data['id'])->get();
       foreach ($answers as $answer) {
           Answer::find($answer['id'])->delete();
       }
       $questions->delete();
       return true;
   }
}
