<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class UpdateCollection extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists,collections,id',
            'name' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data){
        $this->validate($data);
        $collections = Collection::findOrFail($data['id']);
        $collections->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }
}
