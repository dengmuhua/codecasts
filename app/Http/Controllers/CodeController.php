<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Requests\CodeSendToExistUserRequest;
use App\Http\Requests\CodeSendToNotExistUserRequest;
use App\Services\CodeServices;
use Illuminate\Support\Facades\Auth;

class CodeController extends BaseController
{
    public function __construct(){

    }

    /**
     * 发送验证码
     * @param CodeRequest $request
     * @param CodeServices $codeService
     * @return array
     */
    public function send(CodeRequest $request, CodeServices $codeService): array
    {
        $code = $codeService->send($request->account);
        return $this->success('验证码发送成功', $code);
    }

    /**
     * 已经注册的用户获取验证码
     * @param string $type
     * @param CodeServices $codeService
     * @return array
     */
    public function  currentUser(string $type, CodeServices $codeService): array
    {
        $code = $codeService->send(Auth::user()[$type === 'email' ? 'email' : 'mobile']);
        return $this->success('验证码发送成功', $code);
    }

    /**
     * 不存在用户发送验证码
     * @param CodeSendToNotExistUserRequest $request
     * @param CodeServices $codeService
     * @return array
     */
    public function notExistUser(CodeSendToNotExistUserRequest $request, CodeServices $codeService): array
    {
        $code = $codeService->send($request->account);
        return $this->success('验证码发送成功', $code);
    }

    /**
     * 存在用户发送验证码
     * @param CodeSendToExistUserRequest $request
     * @param CodeServices $codeService
     * @return array
     */
    public function existUser(CodeSendToExistUserRequest $request, CodeServices $codeService): array
    {
        $code = $codeService->send($request->account);
        return $this->success('验证码发送成功', $code);
    }
}
