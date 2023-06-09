<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'phone'=> $this->phone,
            'email'=> $this->email,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s'),
            'token' => $this->token,
        ];
    }
}
