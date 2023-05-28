<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:questions,id',
            'question' => 'required',
            'answers' => 'null|array',
            'answers.answer' => 'required_unless:answers,null',
            'answers.is_correct' => 'required_unless:answers,null'
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       $question = Question::find($data['id']);
       $question->update([
           'question' => $data['question'],
       ]);
       $answers = Answer::where('question_id', $data['id'])->get();
       foreach ($answers as $answer) {
           Answer::find($answer['id'])->delete();
       }
       foreach ($data['answers'] as $answer){
           $answer = Answer::create([
               'question_id' => $data['id'],
               'answer' => $answer['answer'],
               'is_correct' => $answer['is_correct'],
           ]);
       }
       return true;
   }
}
