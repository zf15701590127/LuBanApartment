<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class MarketingChannelRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '销售渠道名称 不能为空.',
            'name.max:255' => '销售渠道名称 不能超过 255 个字符.',
        ];
    }
}
