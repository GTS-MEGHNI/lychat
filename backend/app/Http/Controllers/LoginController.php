<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginService $loginService): JsonResponse
    {
        $loginService->authenticate($request->validated());

        return response()->json($loginService->getUser());
    }
}
