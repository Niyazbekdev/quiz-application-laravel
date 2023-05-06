<?php

namespace App\Services\Question;

use App\Models\Question;
use App\Services\BaseServices;
use Illuminate\Database\Eloquent\Collection;

class IndexQuestion extends BaseServices
{
    public function execute(): Collection
    {
       return Question::all('id', 'question', 'created_at');
    }
}
