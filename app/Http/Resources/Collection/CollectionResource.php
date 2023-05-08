<?php

namespace App\Http\Resources\Collection;

use App\Http\Resources\Question\QuestionResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'code'=> $this->code,
            'name'=> $this->name,
            'description'=> $this->description,
            'user'=> new UserResource($this->user),
            'allowed_type'=> $this->allowed_type,
            $this->mergeWhen($request->routeIs('collection.show'), [
                'allowed_users' => UserResource::collection($this->whenLoaded('allowedUsers')),
                'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            ]),
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
