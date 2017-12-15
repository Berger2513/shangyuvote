<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VoteRequest extends Request
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
            'title'=>'required',
            // 'person'=>'required',
            'create_time'=>'required',
            'end_time'=>'required',
            'content'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'请输入标题',
            // 'person.required' => '候选人不能为空',
            'create_time.required' => '起始时间不能为空',
            'end_time.required' => '结束时间不能为空',
            'content.required' => '请输入投票基本内容'
        ];
    }
}
