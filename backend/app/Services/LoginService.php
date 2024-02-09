<?php

namespace App\Services;

use App\Errors;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    private User $user;

    public function authenticate(array $payload): void
    {
        $this->user = User::findByEmail($payload['email']);
        if (! Hash::check($payload['password'], $this->user->password)) {
            throw new HttpResponseException(Errors::wrongPassword());
        }
    }

    public function getUser(): UserResource
    {
        return new UserResource($this->user);
    }
}
