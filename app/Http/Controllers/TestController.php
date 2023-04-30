<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Category;
use App\Models\User;
use App\Services\User\SendCode;
use App\Services\User\VerifyEmail;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TestController extends Controller
{
    public function sendCode(Request $request)
    {
       return app(SendCode::class)->execute($request->all());
    }
    public function identification(Request $request, string $id)
    {
        try {
            return app(VerifyEmail::class)->execute([
            'id' => $id,
            'code' => $request->code,
        ]);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
}
