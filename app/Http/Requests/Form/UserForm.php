<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class UserForm extends Request
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
        $rules = [
            'role_id' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        // 根据RESTful请求的方法来判断是新建还是更新(PUT)
        if ($this->method() === "PUT") {
            // 更新信息时，限制一个id，用于防止校验自身重复
            $rules['name'] = 'required|unique:users,name,' . $_POST["id"];
            $rules['email'] = 'required|unique:users,email,' . $_POST["id"];
        } else {
            $rules['name'] = 'required|unique:users';
            $rules['email'] = 'required|unique:users';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '用户名称不能为空',
            'name.unique' => '用户名称已存在',
            'email.required' => '用户邮箱不能为空',
            'email.unique' => '用户邮箱已存在',
            'role_id.required' => '用户角色不能为空',
            'password.required' => '用户密码不能为空',
            'password.confirmed' => '确认密码不一致',
            'password_confirmation.required' => '确认密码不能为空'
        ];
    }
}
