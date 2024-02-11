<?php

namespace App\Http\Controllers;

use App\Events\UserConnected;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService): JsonResponse
    {
        $loginService->authenticate($request->validated());
        event(new UserConnected(1, $loginService->getUser()->id));

        return response()->json($loginService->getUser());
    }
}
