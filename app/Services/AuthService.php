<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(Request $request)
    {
        $startTime = microtime(true);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->error($request, null, 'Email & Password does not match with our record.', 400, $startTime);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->status == 1) {

            $user['token'] = $user->createToken("API TOKEN")->plainTextToken;
            // $user['role'] = $user->roles->first()->name;

            return response()->success($request, $user, 'User Logged In Successfully.', 200, $startTime, 1);
        } else {
            return response()->error($request, null, 'Your account is Suspend', 401, $startTime);
        }
    }

    public function logout(Request $request)
    {
        $startTime = microtime(true);

        $request->user()->currentAccessToken()->delete();

        return response()->success($request, true, 'User Logged Out Successfully.', 200, $startTime, 1);
    }
}
