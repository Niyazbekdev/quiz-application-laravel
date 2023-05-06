<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:questions,id',
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */

   public function execute(array $data): array
   {
       $this->validate($data);
       $question = Question::findOrFail($data['id']);
       $answers = $question->answers;
       return [$question, $answers];
   }
}
