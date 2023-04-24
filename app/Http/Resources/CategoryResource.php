<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $request->name,
            'created_at' => $request->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $request->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
