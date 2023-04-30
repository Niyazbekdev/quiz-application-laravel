<?php

namespace App\Http\Controllers;

use App\Services\User\LoginUser;
use App\Services\User\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            [$user, $token] = app(RegisterUser::class)->execute($request->all());
            return response([
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'token' => $token,
                ],
            ]);
        }catch (ValidationException $exception){
            return  response([
                'errors' => $exception->validator->errors()->all()
            ], 422);
        }
    }

    public function login(Request $request){
        try {
            [$user, $token, $role] = app(LoginUser::class)->execute($request->all());
            return [
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'role' => $role,
                    'token' => $token,
                ],
            ];
        }catch (ValidationException $exception){
            return response([
                'errors' => $exception->validator->errors()->all()
            ]);
        }catch (\Exception $exception){
            if($exception->getCode() == 401){
                return response([
                    'errors' => $exception->getMessage()
                ], $exception->getCode());
            }
        }
    }

    public function getMe(){
        $user = Auth::user();
        return response([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'nameAndPhone' => $user->nameAndPhone
        ]);
    }
}
