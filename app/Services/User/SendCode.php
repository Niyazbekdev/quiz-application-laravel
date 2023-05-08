<?php

namespace App\Services\User;

use App\Mail\WelcomeMail;
use App\Models\Verification;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use function Termwind\renderUsing;

class SendCode extends BaseServices
{
    /**
     * @throws ValidationException
     */
    public function execute()
    {
        $code = rand(111111, 999999);
        $user = Auth::user();
        $send = Verification::where('user_id', $user['id'])->first();
        if (!$send) {
            Verification::create([
                'user_id' => $user['id'],
                'code' => Hash::make($code),
                'status' => "send code",
            ]);
        } else {
            if ($send['status'] == 'active') {
                return response([
                    'message' => 'you premium account'
                ]);
            } else  {
                $send->update([
                    'code' => Hash::make($code),
                    'status' => "send code",
                ]);
            }
        }
        Mail::to($user['email'])->send(
            new WelcomeMail([
                'name' => 'Welcome to ' . $user['name'] . ' your code: ',
                'code' => $code,
            ])
        );
        return response([
            'success' => true,
        ]);
    }
}
