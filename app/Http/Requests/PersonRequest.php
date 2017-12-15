<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonRequest extends Request
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
            'name'=>'required',
            'image'=>'required',
            'content'=>'required'
        ];
    }

     public function messages()
    {
        return [
            'title.required'=>'请输入标题',
            'image.required'=>'请输入头像',

            'content.required' => '请输入投票基本内容'
        ];
    }
}
