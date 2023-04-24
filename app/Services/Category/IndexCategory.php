<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class IndexCategory extends BaseServices
{
    public function rules(): array
    {
        return [
            'id',
            'name',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): Category
    {
        $this->validate($data, $this->rules());
        return Category::class->find($data);
    }
}
