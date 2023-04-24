<?php

namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseServices
{
    public function rules(): array
    {
        return[];
    }

    /**
     * @throws ValidationException
     */
    public function validate(array $data): bool
    {
        Validator::make($data, $this->rules())->validate();
        return true;
    }
}
