<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginRequest extends BaseRequest
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
            'account' => [$this->accountRules(), Rule::exists('users', $this->fieldName())],
            'password' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    $user = User::query()->where($this->fieldName(), request('account'))->first();
                    if ($user && !Hash::check($value, $user->password)) {
                        $fail('密码输入错误');
                    }
                }
            ]
        ];
    }

    /**
     * RETURN FIELD NAME
     * @return string
     *
     */
    protected function fieldName(): string
    {
        return filter_var(request('account'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    }

    /**
     * CUSTOM RULES
     * @return string[]|void
     */
    protected function accountRules(){
        switch ($this->fieldName()) {
            case 'email':
                return ['required', 'email'];
            case  'mobile':
                return ['required', 'regex:/^\d{11}$/'];
        }
    }
}
