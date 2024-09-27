<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    public function __invoke(RegisterRequest $request, UserServices $userServices): array
    {
        $user = User::query()->create([
            $userServices->fieldName() => $request->account,
            'password' => Hash::make($request->password)
        ]);
        return $this->success(data:[
            'user' => new UserResource($user->refresh()),
            'token' => $user->createToken('auth')->plainTextToken
        ]);
    }
}
