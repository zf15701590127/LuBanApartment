<?php

namespace App\Http\Requests\Fore;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'lease_type_id' => 'required|exists:App\Models\LeaseType,id',
            'sign_contract_type_id' => 'required|exists:App\Models\SignContractType,id',
            'begin_date' => 'required|date',
            'end_date' => 'required|date',
            'lease_term_id' => 'required|exists:App\Models\LeaseTerm,id',
            'room_id' => 'required|exists:App\Models\Room,id',
            'rent' => 'required|numeric|min:0',
            'period_type' => 'required|integer|min:1|max:2',
            'deposit_month_id' => 'required|exists:App\Models\DepositMonth,id',
            'user_id' => 'required|exists:App\Models\User,id',
            'marketing_channel_id' => 'required|exists:App\Models\MarketingChannel,id',
            'customer_name' => 'required|max:255',
            'mobile_phone_number' => ['required',
                                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                                    ],
            'certificate_type_id' => 'required|exists:App\Models\CertificateType,id',
            'certificate_no' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'lease_type_id.requreid' => '租赁类别 不能为空。',
            'sign_contract_type_id.required' => '签约类型 不能为空。',
            'begin_date.required' => '租赁起始日期 不能为空。',
            'end_date.required' => '租赁结束日期 不能为空。',
            'lease_term.required' => '租期 不能为空。',
            'room_id.required' => '房间 不能为空。',
            'rent.required' => '租金 不能为空。',
            'period_type.required' => '周期方式 不能为空。',
            'deposit_month_id.required' => '押金 不能为空。',
            'user_id.required' => '所属销售 不能为空。',
            'marketing_channel_id' => '销售渠道 不能为空。',
            'customer_name.required' => '客户姓名 不能为空。',
            '   .required' => '手机号 不能为空。',
            'certificate_type_id.required' => '证件类型 不能为空。',
            'certificate_no' => '证件信息 不能为空。',
        ];
    }
}
