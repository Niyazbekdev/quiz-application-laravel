<?php

namespace App\Services\User;

use App\Mail\WelcomeMail;
use App\Models\Verification;
use App\Services\BaseServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use function Termwind\renderUsing;

class SendCode extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'exists:verifications,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data)
    {

        $code = rand(111111, 999999);
        $this->validate($data);
        $user = Auth::user();
        $send = Verification::where('user_id', $user['id'])->first();
        if (!$send) {
            $newCode = Verification::create([
                'user_id' => $user['id'],
                'code' => $code,
                'status' => "send code",
            ]);
        } else {
            if ($send['status'] == 'active') {
                return response([
                    'message' => 'you premium account'
                ]);
            } else {
                $send->update([
                    'code' => $code,
                ]);
            }
        }
        Mail::to($user['email'])->send(
            new WelcomeMail([
                'name' => 'Hi dear ' . $user['name'] . ' your code: ',
                'code' => $code,
            ])
        );
        return response([
            'success' => true,
        ]);
    }
}
