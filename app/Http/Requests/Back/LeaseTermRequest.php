<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class LeaseTermRequest extends FormRequest
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
            'name' => 'required|max:255',
            'number' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '租赁周期名称 不能为空.',
            'number.required' => '租赁周期对应月数 不能为空.',
            'name.max:255' => '租赁周期名称 最长不能超过 255 个字符.',
            'number.integer' => '租赁周期对应月数 只能是整数.',
            'number.min' => '租赁周期对应月数 不能小于 1.',
        ];
    }
}
