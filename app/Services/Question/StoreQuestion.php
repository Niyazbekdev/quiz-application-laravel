<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StoreQuestion extends BaseServices
{
    private array $answers;
    public function rules(): array
    {
        return [
            'collection_id' => 'required',
            "questions" => "nullable|array",
            "questions.*.question" => "required_unless:questions,null",
            "questions.*.answers" => "required_unless:questions,null",
            "questions.*.answers.*.answer" => "required_unless:questions,null",
            "questions.*.answers.*.is_correct" => "required_unless:questions,null|boolean",
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       foreach ($data['questions'] as $question) {
           $answers = collect($question['answers']);
           $question = Question::create([
               'collection_id' => $data['collection_id'],
               'question' => $question['question'],
               'correct_answers' => $answers->where('is_correct', true)->count(),
           ]);
           foreach ($answers as $answer){
               $this->answers[] = [
                   'question_id'=> $question->id,
                   'answer'=> $answer['answer'],
                   'is_correct'=> $answer['is_correct'],
               ];
           }
           DB::table('answers')->insert($this->answers);
           $this->answers = [];
       }
       return true;
   }
}
