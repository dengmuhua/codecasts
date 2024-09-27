<?php

namespace App\Rules;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Validation\Rule;

class ValidateCodeRule implements  Rule
{
    public function __construct()
    {
        //
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     * @throws BindingResolutionException
     */
    public function passes($attribute, $value): bool
    {
        return request('account') && $value && app('code')->check(request('account'), $value);
    }

    /**
     * 验证码失败信息
     * @return string
     */
    public function message(): string
    {
        return '验证码错误';
    }
}
