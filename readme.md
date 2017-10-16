## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

## 说明
> 该项目是基于Laravel5.4，然后根据多个【APP API + 后台管理CMS】类型的项目综合整理而出的快速打通API+CMS功能的开发模板。  
目前已经成功上线的有电商、医疗、社交、在线教育等4个项目。  
会持续更新，并补充Laravel5.5 + Vue的模板。  

## Project Doc  
- 测试Server环境：  
Apache 2.2 + MySQL 5.6 + PHP 5.6  
[CentOS安装教程](http://mvpxuan.lofter.com/post/230e17_94f2efe)

- CMS已经部署好（需配置数据库和.env之后）：  
直接访问：localhost/cms  
用户名：admin@admin.com  
密码：123456  

- API文档已经部署好（需配置.env之后）：  
直接访问：localhost/doc


### 一、项目配置
#### 1 . 配置文件.env
使用.env.example加入git管理，实际使用时复制.env.example文件并改名为.env：  

    # cp .env.example .env
> 注意：需自行增加APP_KEY和DB的IP/账号/密码

#### 2 前后端资源node_modules和vendor
```bash
$ npm install
$ composer install
```

### 二、项目数据库部署
配置env文件的数据配置之后，执行以下几条：
```$xslt
php artisan migrate:install
php artisan migrate
php artisan db:seed
```
    
### 三、项目目录结构
#### 1. 路由
routes下api对应的是接口，web对应的是cms。

#### 2. 模型
分三个目录：
Api（APP用户管理等）、Business（业务模块）、Cms（内容管理系统相关）

#### 3. 控制器
3.1 API控制器目录：../app/Api/Controllers/  
> API文档文件：../app/Api/Controllers/ApiDoc.php  
> 访问以下链接即可:  
    
    localhost/api

在以下中间件中的都是需要token授权访问的内容：

     /**
     * Token Auth
     */
         $api->group(['middleware' => 'jwt.auth'], function ($api) {
         }

api授权接口访问示例（通过login接口获取token）：

    localhost/v1/info/all-type?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI


3.2 验证控制器目录： ../app/Http/Controllers/Auth/  
3.3 CMS控制器目录： ../app/Http/Controllers/Backend/  
3.4 业务控制器目录： ../app/Http/Controllers/Business/

#### 4. 视图
CMS业务管理目录：../resources/views/

#### 5. 数据库迁移和填充
自定义迁移部分：  
../database/migrations/2017_06_14_100454_create_menus_table.php  
../database/migrations/2017_06_14_134742_entrust_setup_tables.php

填充部分：  
../database/seeds/DatabaseSeeder.php

#### 6. Helper
../app/Api/Helper/  
../app/Http/Helper/

#### 7. Requests
实例文件：../app/Http/Requests/Form/MenuForm.php  
用法：

    use App\Http\Requests\Form\MenuForm;

    public function store(MenuForm $request)
    {
        //能进入到此函数体的，都已经被MenuForm的Requests过滤了
        /**
            Laravel文档：
            http://d.laravel-china.org/docs/5.4/validation
        */
    }

#### 8. Transformers
// TODO。


### 四、特殊说明
#### 1. 中间件
../app/Http/Middleware/JwtAuthModel.php  
该中间件为自定义，用来给API导航用哪张用户表。

#### 2. 已经自带一个评论前端插件
../resources/views/layouts/comment.blade.php
