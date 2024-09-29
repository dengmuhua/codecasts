<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 登录注册
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

// 验证码
Route::post('code/send', [CodeController::class,'send']);

// 系统配置
Route::apiResource('configs', ConfigController::class)->only(['index', 'update']);
