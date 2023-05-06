<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowAnswer extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:answers,id',
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */

   public function execute(array $data): Answer
   {
       $this->validate($data, $this->rules());
       return (Answer::findOrFail($data['id']));
   }
}
