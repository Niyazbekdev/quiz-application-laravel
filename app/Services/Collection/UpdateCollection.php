<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UpdateCollection extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:collections,id',
            'name' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function execute(array $data): Collection
    {
        $this->validate($data);
        $collections = Collection::find($data['id']);
        $collections->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        return $collections;
    }
}
