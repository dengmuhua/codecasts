<?php

namespace App\Http\Requests;

use App\Rules\ValidateCodeRule;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'account' => $this->accountRules(),
            'password' => ['required', 'min:6', 'confirmed']
        ];
    }

    public function withValidator($validator): void
    {
        $validator->sometimes('code', ['required', new ValidateCodeRule], function ($input) {
            return app()->environment() == 'production' || request('code');
        });
    }

    /**
     * 根据账号类型返回验证规则
     * @return string[]
     */
    protected function accountRules(): array
    {
        if (filter_var(request('account'), FILTER_VALIDATE_EMAIL))
            return ['required', 'email', 'unique:users,email'];
        return ['required', 'regex:/^\d{11}$/', 'unique:users,phone'];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return ['code.required' => '验证码不能为空'];
    }
}
