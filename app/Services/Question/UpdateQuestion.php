<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:questions,id',
            'question' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       $question = Question::find($data['id']);
       $question->update([
           'question' => $data['question'],
       ]);
       return true;
   }
}
