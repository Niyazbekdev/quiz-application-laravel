<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUser extends BaseServices
{
 public function rules(): array
 {
     return [
         'phone'=> 'required',
            'password'=> 'required',
     ];
 }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    public function execute(array $data): array
 {
    $this->validate($data);
    $user = User::where('phone', $data['phone'])->first();
    if(!$user or !Hash::check($data['password'], $user->password)){
        throw new \Exception('user not found or password in correct', 401);
    }
    $role = $user->is_admin ? 'admin': 'user';
    $token = $user->createToken('user model', [$role])->plainTextToken;
    return [$user, $token, $role];
 }
}
