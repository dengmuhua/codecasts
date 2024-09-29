<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeSendToExistUserRequest extends FormRequest
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
            'account' => ['required', $this->accountRules(), 'exists:users,' . $this->accountFiled()]
        ];
    }

    /**
     * 自定义规则
     * @return string
     */
    protected function accountRules(): string
    {
        return filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'regex:/^\d{11}$/';
    }

    /**
     * 返回字段名称
     * @return string
     */
    protected function accountFiled(): string
    {
        return filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    }
}
