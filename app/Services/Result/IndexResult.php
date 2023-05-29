<?php

namespace App\Services\Result;

use App\Models\Result;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class IndexResult extends BaseServices
{
    public function rules(): array
    {
        return [];
    }

    /**
     * @throws ValidationException
     */
   public function execute(array $data)
   {
       $this->validate($data);
        return Result::all('id', 'collection_id', 'question_id', 'answer_id', 'is_correct');
   }
}
