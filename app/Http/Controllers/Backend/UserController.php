<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\cms\Role;
use App\Models\cms\User;
use App\Http\Requests\Form\UserForm;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page_level = "系统管理";

    public function index()
    {
        $users = User::paginate(25);
        $page_title = "用户列表";
        $page_level = $this->page_level;

        return view('users.index', compact('users', 'page_title', 'page_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $page_title = "新建用户";
        $page_level = $this->page_level;

        return view('users.create', compact('roles', 'page_title', 'page_level'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param UserForm $request
     * 
     * @return mixed
     */
    public function store(UserForm $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ];

        try {
            $roles = Role::whereIn('id', $request->get('role_id'))->get();
            if (empty($roles->toArray())) {
                return redirect()->back()->withErrors("用户角色不存在,请刷新页面并选择其他用户角色")->withInput();
            }

            $user = User::create($data);
            if ($user) {
                foreach ($roles as $role) {
                    $user->attachRole($role);
                }

                return redirect()->route('user.index')->withSuccess('新增用户成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $userRoles = $user->roles->toArray();
        $displayNames = array_map(function ($value) {
            return $value['display_name'];
        }, $userRoles);
        $page_title = "编辑用户";
        $page_level = $this->page_level;

        return view('users.edit', compact('user', 'roles', 'displayNames', 'page_title', 'page_level'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UserForm $request
     * @param $id
     * 
     * @return mixed
     */
    public function update(UserForm $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        try {
            $roles = Role::whereIn('id', $request->get('role_id'))->get();
            if (empty($roles->toArray())) {
                return redirect()->back()->withErrors("用户角色不存在,请刷新页面并选择其他用户角色")->withInput();
            } else {
                if ($user->save()) {
                    foreach ($roles as $role) {
                        $user->attachRole($role);
                    }

                    return redirect()->route('user.index')->withSuccess('编辑用户成功');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (User::destroy($id)) {
                return redirect()->back()->withSuccess('删除用户成功');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(array('error' => $e->getMessage()));
        }
    }
}
