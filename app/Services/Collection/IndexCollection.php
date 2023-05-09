<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class IndexCollection extends BaseServices
{
    public function rules(): array
    {
        return [
            'search' => 'nullable',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validate($data);
        return Collection::with('user')->when($data['search'] ?? null, function ($query, $search) {
            $query->search($search);
        })->paginate(10);
    }
}
