<?php

namespace App\Services;

use Illuminate\Contracts\Container\BindingResolutionException;

class UserServices
{
    /**
     * 登录是需要的字段
     * @return string
     * @throws BindingResolutionException
     */
    public function fieldName(): string
    {
        return filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    }
}
