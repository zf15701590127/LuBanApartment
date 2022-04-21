<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
        switch($this->method())
        {
            // create
            case 'POST':
                {
                    return [
                        'name' => 'required|unique:users|max:255',
                        'email' => 'required|email|unique:users|max:255',
                        'password' => 'required|confirmed|min:6'
                    ];
                }
                break;
            // UPDATE
            case 'PATCH':
                {
                    return [
                        'name' => 'required|max:255|unique:users,name,' . Auth::id(),
                        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
                        'password' => 'nullable|confirmed|min:6'
                    ];
                }
                break;
        }
    }

    public function messages()
    {
        return [
            'name.unique' => '用户名已被占用，请重新填写',
            'name.required' => '用户名不能为空。',
            'password.min' => '密码至少 6 位。',
            'password.confirmed' => '密码与重复密码不一致。',
            'password.required' => '密码不能为空。',
            'email.unique' => '邮箱已被注册。',
            'email.required' => '邮箱不能为空。',
        ];
    }
}
