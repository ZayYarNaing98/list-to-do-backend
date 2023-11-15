<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $startTime = microtime(true);

        try {
            $data = $this->service->login($request);

            return $data;
        } catch (Exception $e) {
            Log::channel('todo')->error('Login Error' . $e->getMessage());

            return response()->error(request(), null, $e->getMessage(), 500,   $startTime);
        };
    }

    public function logout(Request $request)
    {
        $startTime = microtime(true);

        try {
            $data = $this->service->logout($request);

            return $data;
        } catch (Exception $e) {
            Log::channel('todo')->error('Logout Error' . $e->getMessage());

            return response()->error(request(), null, $e->getMessage(), 500, $startTime);
        }
    }
}
