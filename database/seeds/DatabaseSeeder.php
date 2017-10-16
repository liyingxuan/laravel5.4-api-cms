<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\cms\Menu;
use App\Models\cms\Role;
use App\Models\cms\User;
use App\Models\cms\Permission;
use App\Models\cms\RoleUser;
use App\Models\cms\PermissionRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        Model::reguard();
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("users")->delete();

        User::create(["name" => "admin", "email" => "admin@admin.com", "password" => bcrypt(123456)]);
    }
}

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("menus")->delete();

        Menu::create(["parent_id" => "0", "name" => "首页管理", "url" => "index", "description" => "展示系统的各项基础数据"]); //id：1

//        Menu::create(["parent_id" => "0", "name" => "品牌类型", "url" => "type.index", "description" => ""]);
//        Menu::create(["parent_id" => "0", "name" => "新增类型", "url" => "type.create", "description" => "", "is_hide" => 1]);
//        Menu::create(["parent_id" => "0", "name" => "编辑类型", "url" => "type.edit", "description" => "", "is_hide" => 1]);
//
//        Menu::create(["parent_id" => "0", "name" => "品牌信息", "url" => "info.index", "description" => ""]);
//        Menu::create(["parent_id" => "0", "name" => "新增品牌", "url" => "info.create", "description" => "", "is_hide" => 1]);
//        Menu::create(["parent_id" => "0", "name" => "编辑品牌", "url" => "info.edit", "description" => "", "is_hide" => 1]);
//
//        Menu::create(["parent_id" => "0", "name" => "门店信息", "url" => "store.index", "description" => ""]);
//        Menu::create(["parent_id" => "0", "name" => "新增门店", "url" => "store.create", "description" => "", "is_hide" => 1]);
//        Menu::create(["parent_id" => "0", "name" => "编辑门店", "url" => "store.edit", "description" => "", "is_hide" => 1]);
//
//        Menu::create(["parent_id" => "0", "name" => "优惠信息", "url" => "discount.index", "description" => ""]);
//        Menu::create(["parent_id" => "0", "name" => "新增优惠", "url" => "discount.create", "description" => "", "is_hide" => 1]);
//        Menu::create(["parent_id" => "0", "name" => "编辑优惠", "url" => "discount.edit", "description" => "", "is_hide" => 1]);

    }
}

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("roles")->delete();

        Role::create(["name" => "admin", "display_name" => "User Administrator", "description" => "User is allowed to manage and edit other users"]);
        Role::create(["name" => "owner", "display_name" => "Project Owner", "description" => "User is the owner of a given project"]);
    }
}

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("permissions")->delete();

        Permission::create(["display_name" => "首页管理", "name" => "index"]); // id:1

//        Permission::create(["display_name" => "品牌类型", "name" => "type.index"]); // id:2
//        Permission::create(["display_name" => "新增类型", "name" => "type.create"]);
//        Permission::create(["display_name" => "保存类型", "name" => "type.store"]);
//        Permission::create(["display_name" => "编辑类型", "name" => "type.edit"]);
//        Permission::create(["display_name" => "更新类型", "name" => "type.update"]);
//
//        Permission::create(["display_name" => "品牌信息", "name" => "info.index"]); // id:7
//        Permission::create(["display_name" => "新增品牌", "name" => "info.create"]);
//        Permission::create(["display_name" => "保存品牌", "name" => "info.store"]);
//        Permission::create(["display_name" => "编辑品牌", "name" => "info.edit"]);
//        Permission::create(["display_name" => "更新品牌", "name" => "info.update"]);
//
//        Permission::create(["display_name" => "门店信息", "name" => "store.index"]); // id:12
//        Permission::create(["display_name" => "新增门店", "name" => "store.create"]);
//        Permission::create(["display_name" => "保存门店", "name" => "store.store"]);
//        Permission::create(["display_name" => "编辑门店", "name" => "store.edit"]);
//        Permission::create(["display_name" => "更新门店", "name" => "store.update"]);
//
//        Permission::create(["display_name" => "优惠信息", "name" => "discount.index"]); // id:17
//        Permission::create(["display_name" => "新增优惠", "name" => "discount.create"]);
//        Permission::create(["display_name" => "保存优惠", "name" => "discount.store"]);
//        Permission::create(["display_name" => "编辑优惠", "name" => "discount.edit"]);
//        Permission::create(["display_name" => "更新优惠", "name" => "discount.update"]); // id:21
    }
}

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("role_user")->delete();

        RoleUser::create(["user_id" => 1, "role_id" => 1]);
    }
}

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table("permission_role")->delete();

        /**
         * 权限role
         */
        for ($role = 1; $role <= 2; $role++) {
            for ($permission = 1; $permission <= 1; $permission++) {
//            for ($permission = 1; $permission <= 21; $permission++) {
                PermissionRole::create(["permission_id" => $permission, "role_id" => $role]);
            }
        }
    }
}
