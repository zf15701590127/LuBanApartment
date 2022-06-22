<?php

namespace App\Http\Requests\Fore;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'amount' => 'required|min:0|numeric',
            'paymentTypeId' => 'required|exists:App\Models\PaymentType,id'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => '支付金额 不能为空。',
            'amount.min' => '支付金额 不能小于 0',
            'paymentTypeId.required' => '支付方式 不能为空。',
            'paymentTypeId.exists' => '支付类型 参数错误。',
        ];
    }
}
