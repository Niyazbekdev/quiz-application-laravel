<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Verification;
use App\Services\BaseServices;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VerifyEmail extends BaseServices
{
    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }
    /**
     * @throws ValidationException
     */
    public function execute(array $data)
    {
        $this->validate($data);
        $nowTime = Carbon::now()->addMinute(-1);
        $user = Auth::user();
        $code = Verification::where('code', $data['code'])->first();
        $send = Verification::where('user_id', $user['id'])->first();
        $attempt = $send['attempt'];
        if ($send['status'] == 'active') {
            return response([
                'your code is active',
            ]);
        } else {
            $createTime = $send['updated_at'];
            if($nowTime > $createTime){
                $send->update([
                    'status' => 'time over',
                ]);
                return response([
                    'message' => 'your code time over , please reset send code',
                ]);
            }else {
                if ($code) {
                    $attempt++;
                    $send->update([
                        'attempt' => $attempt,
                        'status' => 'active',
                    ]);
                    $premiumUser = User::where('id', $user['id']);
                    $premiumUser->update([
                        'is_premium' => true,
                    ]);
                    return response([
                        'success' => true,
                    ]);
                } else {
                    $attempt++;
                    if ($attempt < 11) {
                        $send->update([
                            'attempt' => $attempt,
                            'status' => 'attempt: ' . $attempt,
                        ]);
                        return response([
                            'message' => 'your code correct',
                        ]);
                    } else {
                        $send->update([
                            'status' => 'attempt over',
                        ]);
                        return response([
                            'message' => 'your attempt over',
                        ]);
                    }
                }
            }
        }
    }
}
