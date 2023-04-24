<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class StoreCategory extends BaseServices
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories,name'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): Category
    {
        $this->validate($data, $this->rules());
        return Category::create($data);
    }
}
