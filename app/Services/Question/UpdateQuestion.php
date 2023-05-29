<?php

namespace App\Services\Question;

use App\Models\Answer;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Support\Facades\DB;
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
       $question = Question::findOrFail($data['id']);
       $oldAnswers = $question->answers->pluck('answers');
       $answers = collect($question['answers']);

       $question->update([
           'question' => $data['question'],
           'correct_answers' => $answers->where('is_correct', true)->count(),
       ]);
       foreach ($answers as $answer){
           if(in_array($answer['answer'], $oldAnswers)){
               $this->$answers[] = [
                   'question_id' => $question->id,
                   'answer' => $answer['answer'],
                   'is_correct' => $answer['is_correct']
               ];
           }
       }
       if(!empty($this->answers)){
           DB::table('answers')->insert($this->answers);
       }
       return true;
   }
}
