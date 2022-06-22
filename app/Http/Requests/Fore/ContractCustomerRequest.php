<?php

namespace App\Http\Requests\Fore;

use Illuminate\Foundation\Http\FormRequest;

class ContractCustomerRequest extends FormRequest
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
            'certificate_type_id' => 'required|exists:App\Models\CertificateType,id',
            'certificate_no' => 'required|max:255',
            'mobile_phone_number' => ['required',
                                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                                    ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入住人姓名 不能为空.',
            'certificate_type_id.required' => '证件类型 不能为空.',
            'certificate_type_id.exists' => '证件类型 参数错误.',
            'certificate_no.required' => '证件号 不能为空.',
            'mobile_phone_number.required' => '手机号 不能为空.',
            'mobile_phone_number.regex' => '手机号 格式不正确.'
        ];
    }
}
