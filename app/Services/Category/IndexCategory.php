<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class IndexCategory extends BaseServices
{
    public function rules(): array
    {
        return [];
    }
    public function execute(array $data): Collection
    {
        return Category::all(['id', 'name', 'created_at', 'updated_at']);
    }
}
