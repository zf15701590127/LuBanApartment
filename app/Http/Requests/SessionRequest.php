<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email 不能为空.',
            'email.email' => 'email 格式不正确.',
            'email.max' => 'email 最长不能超过 255.',
            'password.required' => '密码 不能为空.',
            'password.max' => '密码 最长不能超过 255.'
        ];
    }
}
