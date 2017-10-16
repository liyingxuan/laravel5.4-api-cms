<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class PermissionForm extends Request
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
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '权限标识不能为空',
            'display_name.required' => '权限名称不能为空',
            'description.required' => '权限描述不能为空'
        ];
    }
}
