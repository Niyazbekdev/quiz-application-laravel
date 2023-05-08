<?php

namespace App\Services\Collection;

use App\Models\Collection;
use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ShowCollection extends BaseServices
{
    private array $answers;
    public function rules(): array
    {
        return [
            'id'=> 'required|exists:collections,id'
        ];
    }

    /**
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function execute(array $data): array
    {
        $this->validate($data);
        $collection = Collection::with(['allowedUsers', 'questions', 'user'])->findOrFail($data['id']);
        return [$collection];
    }
}
