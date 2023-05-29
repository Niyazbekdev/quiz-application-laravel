<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @throws ModelNotFoundException
     */

   public function execute(array $data): bool
   {
       $this->validate($data);
       Answer::findOrFail($data['id'])->delete();
       return true;
   }
}
