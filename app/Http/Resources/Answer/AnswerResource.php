<?php

namespace App\Http\Resources\Answer;

use App\Http\Resources\Question\QuestionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'question_id' => $this->question_id,
            'answer'=> $this->answer,
        ];
    }
}
