<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $startTime = microtime(true);

            $data = $this->service->getUsers();

            $result = UserResourse::collection($data);

            return response()->success(request(), $result, 'User Retrieved Successfully.', 200, $startTime, count($data));

        } catch (Exception $e) {
            Log::channel('todo')->error('Error Retrieved User : ' . $e->getMessage());

            return response()->error(request(), null, $e->getMessage(), 500,   $startTime);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
