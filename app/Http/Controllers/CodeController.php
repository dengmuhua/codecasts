<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Services\CodeServices;

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
}
