<?php

namespace App\Http\Requests;


class CodeRequest extends BaseRequest
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
        ];
    }

    /**
     * @return string[]
     */
    protected function accountRules(): array
    {
        if (filter_var(request('account'), FILTER_VALIDATE_EMAIL))
            return ['required', 'email'];
        return ['required', 'regex:/^\d{11}$/'];
    }
}
