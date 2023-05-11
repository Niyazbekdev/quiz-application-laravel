<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class IndexAnswer extends BaseServices
{
    public function rules(): array
    {
        return [
          'search' => 'nullable',
        ];
    }

    /**
     * @throws ValidationException
     */

   public function execute(array $data)
   {
       $this->validate($data);
       return Answer::with('question')->when($data['search'] ?? null, function ($query, $search){
            $query->search($search);
       })->paginate(10);
   }
}
