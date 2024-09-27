<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServices;

class LoginController extends BaseController
{
    public function __invoke(LoginRequest $request, UserServices $userServices): array
    {
        $user = User::query()->where($userServices->fieldName(), $request->account)->first();
        return $this->success(data:[
            'user' => new UserResource($user),
            'token' => $user->createToken('auth')->plainTextToken
        ]);
    }
}
