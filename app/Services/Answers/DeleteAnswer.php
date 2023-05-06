<?php

namespace App\Services\Answers;

use App\Http\Resources\Answer\AnswerAnswer;
use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteAnswer extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:answers,id',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       Answer::find($data['id'])->delete();
       return true;
   }
}
