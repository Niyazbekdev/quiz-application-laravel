<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\Collection;

class IndexQuestion extends BaseServices
{
    public function rules(): array
    {
        return [
            'search' => 'nullable',
        ];
    }

    public function execute(array $data)
    {
       $this->validate($data);
        return Question::with('collection')->when($data['search'] ?? null, function ($query, $search) {
            $query->search($search);
        })->paginate(10);
    }
}
