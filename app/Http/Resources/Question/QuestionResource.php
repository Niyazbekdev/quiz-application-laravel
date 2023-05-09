<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\Answer\AnswerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'question'=> $this->question,
            'correct_answers'=> $this->correct_answers,
            $this->mergeWhen($request->routeIs('question.show'), [
                'answers' =>AnswerResource::collection($this->whenLoaded('answers')),
            ]),
            'created_at'=> $this->created_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),
        ];
    }
}
