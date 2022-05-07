<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'building_id' => 'required|integer|min:0|exists:App\Models\Building,id',
            'name' => 'required|max:255',
            'floor' => 'required|integer|min:0',
            'purpose_id' => 'required|integer|min:0|exists:App\Models\Purpose,id',
            'benchmark_price' => 'required|numeric|min:0',
            'store_price' => 'required|numeric|min:0',
            'order' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => '项目名称 不能为空.',
            'project_id.integer' => '项目名称 参数非法.',
            'project_id.min' => '项目名称 参数非法.',
            'building_id.required' => '楼栋名称 不能为空.',
            'name.required' => '房间名称 不能为空.',
            'floor.required' => '楼层 不能为空.',
            'purpose_id .required' => '用途名称 不能为空.',
            'benchmark_price.required' => '基础价格 不能为空.',
            'store_price.required' => '门店价格 不能为空.',
            'order.required' => '排序 不能为空.',
        ];
    }
}
