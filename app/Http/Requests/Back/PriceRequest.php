<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'project_id' => 'required|integer|min:0|exists:App\Models\Project,id',
            'deposit' => 'required|min:0|numeric',
            'cold_water_fee' => 'required|min:0|numeric',
            'electricity_fee' => 'required|min:0|numeric',
            'change_room_fee' => 'required|min:0|numeric'
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => '项目名称 不能为空.',
            'deposit.required' => '定金 不能为空.',
            'cold_water_fee' => '冷水费 不能为空.',
            'electricity_fee' => '电费 不能为空.',
            'change_room_fee' => '换房费 不能为空.'
        ];
    }
}
