<?php

namespace App\Http\Requests\Fore;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'begin_date' => 'required|date',
            'end_date' => 'required|date',
            'lease_term_id' => 'required|exists:App\Models\LeaseTerm,id',
            'room_id' => 'required|exists:App\Models\Room,id',
            'rent' => 'required|numeric|min:0',
            'deposit_month_id' => 'required|exists:App\Models\DepositMonth,id',
            'name' => 'required|max:255',
            'mobile_phone_number' => ['required',
                                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                                    ],
            'reserve_amount' => 'required|min:0',
        ];
    }

    public function messages()
    {
        return [
            'lease_type_id.requreid' => '租赁类别 不能为空。',
            'begin_date.required' => '租赁起始日期 不能为空。',
            'end_date.required' => '租赁结束日期 不能为空。',
            'lease_term.required' => '租期 不能为空。',
            'room_id.required' => '房间 不能为空。',
            'rent.required' => '租金 不能为空。',
            'deposit_month_id.required' => '押金 不能为空。',
            'name.required' => '客户姓名 不能为空。',
            'mobile_phone_number.required' => '手机号 不能为空。',
            'reserve_amount.required' => '定金 不能为空。',
        ];
    }
}
