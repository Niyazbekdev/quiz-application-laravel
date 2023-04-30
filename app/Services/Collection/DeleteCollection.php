<?php

namespace App\Services\Collection;

use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteCollection extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:collections,id'
            ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): bool
    {
        $this->validate($data, $this->rules());
        $collection = Collection::find($data['id']);
        $questions = Question::where('collection_id', $data['id'])->get();
        foreach ($questions as $question){
            $answers = Answer::where('question_id', $question['id'])->get();
            foreach ($answers as $answer){
                Answer::find($answer['id'])->delete();
            }
            Question::find($question['id'])->delete();
        }
        $collection->delete();
        return true;
    }
}
