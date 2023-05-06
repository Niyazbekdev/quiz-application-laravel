<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ShowCategory extends BaseServices
{
    public function rules(): array
    {
        return [
            'name',
        ];
    }
    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function execute(array $data)
    {
        $this->validate($data, $this->rules());
        $category = Category::where('id', $data['id'])->withTrashed()->first();
        if(!$category){
            return response([
                'message' => 'category not found',
            ]);
        }else{
            return $category;
        }
    }
}
