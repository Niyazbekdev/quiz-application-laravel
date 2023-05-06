<?php

namespace App\Services\Answers;

use App\Models\Answer;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class UpdateAnswer extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:answers,id',
            'answer' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     */

    public function execute(array $data): bool
    {
        $this->validate($data);
        $answer = Answer::find($data['id']);
        $answer->update([
            'answer' => $data['answer'],
        ]);
        return true;
    }
}
