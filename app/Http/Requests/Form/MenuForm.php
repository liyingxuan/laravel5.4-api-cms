<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class MenuForm extends Request
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
            'url' => 'required',
            'name' => 'required',
            'parent_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'url.required' => '菜单地址不能为空',
            'name.required' => '菜单名称不能为空',
            'parent_id.required' => '父级分类不能为空'
        ];
    }
}
