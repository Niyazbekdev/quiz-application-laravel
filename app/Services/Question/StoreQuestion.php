<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class StoreQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'collection_id' => 'required',
            'question' => 'required',
            'answers' => 'nullable|array',
            'answers.*.answer' => 'required_unless:answers,null',
            'answers.*.is_correct' => 'required_unless:answers,null|boolean',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       $question = Question::create([
           'collection_id' => $data['collection_id'],
           'question' => $data['question'],
       ]);
       foreach ($data['answers'] as $answer){
           $answer = Answer::create([
               'question_id' => $question->id,
               'answer' => $answer['answer'],
               'is_correct' => $answer['is_correct'],
           ]);
       }
       return true;
   }
}
