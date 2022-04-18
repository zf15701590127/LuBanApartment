<?php

namespace App\Http\Requests;

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
                        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
                        'avatar' => 'mimes:png,jpg,gif,jpeg|dimensions:min_width=208,min_height=208',
                    ];
                }
            default:
                {
                    return [];
                };
        }

    }

    public function messages()
    {
        return [
            'avatar.mimes' => '头像必须是 png, jpg, gif, jpeg 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 208px 以上',
            'name.unique' => '用户名已被占用，请重新填写',
            'name.required' => '用户名不能为空。',
            'email.unique' => '邮箱已被注册。',
            'password.min' => '密码至少 6 位。',
            'password.confirmed' => '密码与重复密码不一致。',
            'email.required' => '邮箱不能为空。',
            'password.required' => '密码不能为空。',
        ];
    }
}
