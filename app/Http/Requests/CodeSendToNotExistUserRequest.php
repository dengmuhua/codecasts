<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CodeSendToNotExistUserRequest extends FormRequest
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
            'account' => ['required', $this->accountRules(), $this->accountExistsCheck()],
        ];
    }

    /**
     * 返回字段名称
     * @return string
     */
    protected function accountRules(): string
    {
        return filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    }

    /**
     * 检测账号
     * @return \Closure
     */
    protected function accountExistsCheck(): \Closure
    {
        return function($attribute, $value, $fail){
            $fieldName = filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            $isExists = User::query()->where($fieldName, $value)->exists();
            if ($isExists){
                $fail('账号已存在');
            }
        };
    }
}
