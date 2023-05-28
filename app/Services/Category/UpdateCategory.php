<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UpdateCategory extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:categories,id',
            'name'=>'required'
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function execute(array $data): Category
    {
        $this->validate($data, $this->rules());
        $category = Category::find($data['id']);
        $category->update([
            'name' => $data['name'],
        ]);
        return $category;
    }
}
