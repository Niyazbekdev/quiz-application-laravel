<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class IndexAnswer extends BaseServices
{
    /**
     * @throws ValidationException
     */

   public function execute(array $data): Collection
   {
       $this->validate($data);
       return Answer::all('id', 'question_id', 'answer', 'is_correct');
   }
}
