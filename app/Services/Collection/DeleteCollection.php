<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteCollection extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:collections,id'
            ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): array
    {
        $this->validate($data, $this->rules());
        $collection = Collection::find($data['id']);
        $questions = Question::with('collection_id', $collection)->delete();
        $collection->delete();
        return [$collection, $questions];
    }
}
